/**
 * LC-PULSO Community App — Client-side Logic
 * Optimistic UI, infinite scroll, pull-to-refresh, real-time
 */
(function () {
  'use strict';

  /* ── Config ─────────────────────────────────────────────────── */
  const API = 'api/community.php';
  const CSRF = document.querySelector('meta[name="csrf-token"]')?.content || '';
  const POLL_INTERVAL = 4000;
  const NOTIF_INTERVAL = 10000;
  const PAGE_SIZE = 12;

  /* ── State ──────────────────────────────────────────────────── */
  let state = {
    category: 'all',
    subject: 'all',
    mode: 'for_you',
    sort: 'recent',
    search: '',
    cursor: 0,
    nextCursor: null,
    latestId: 0,
    firstLoad: true,
    loading: false,
    loadingMore: false,
    posts: [],
    stories: [],
    notifications: [],
    unreadCount: 0,
    currentUserId: 0,
    theme: localStorage.getItem('cp-theme') || 'dark',
    pollTimer: null,
    notifTimer: null,
  };

  /* ── Helpers ────────────────────────────────────────────────── */
  const $ = (id) => document.getElementById(id);
  const $$ = (sel) => document.querySelectorAll(sel);

  function esc(val) {
    const node = document.createElement('div');
    node.textContent = val ?? '';
    return node.innerHTML;
  }

  function initials(name) {
    return esc((name || '?').trim().slice(0, 1).toUpperCase());
  }

  function timeAgo(value) {
    const now = Date.now();
    const then = new Date(value.replace(' ', 'T')).getTime();
    const diff = Math.floor((now - then) / 1000);
    if (diff < 60) return 'ahora';
    if (diff < 3600) return Math.floor(diff / 60) + 'm';
    if (diff < 86400) return Math.floor(diff / 3600) + 'h';
    if (diff < 604800) return Math.floor(diff / 86400) + 'd';
    return new Date(value.replace(' ', 'T')).toLocaleDateString('es-MX', { day: '2-digit', month: 'short' });
  }

  function toast(text) {
    const node = document.createElement('div');
    node.className = 'cp-toast';
    node.textContent = text;
    document.body.appendChild(node);
    setTimeout(() => node.remove(), 2800);
  }

  async function api(action, data = {}) {
    try {
      const response = await fetch(API, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action, csrf_token: CSRF, ...data }),
      });
      return await response.json();
    } catch (e) {
      return { ok: false, error: 'Error de conexión' };
    }
  }

  async function apiGet(params = {}) {
    try {
      const query = new URLSearchParams(params);
      const response = await fetch(`${API}?${query}`);
      return await response.json();
    } catch (e) {
      return { ok: false, error: 'Error de conexión' };
    }
  }

  function categoryLabel(key) {
    return { general: 'General', pregunta: 'Pregunta', logro: 'Logro', proyecto: 'Proyecto', recursos: 'Recurso' }[key] || 'General';
  }

  /* ── Markdown-lite renderer ─────────────────────────────────── */
  function renderMarkdown(text) {
    if (!text) return '';
    let html = esc(text);
    // Bold
    html = html.replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>');
    // Italic
    html = html.replace(/\*(.+?)\*/g, '<em>$1</em>');
    // Inline code
    html = html.replace(/`([^`]+)`/g, '<code>$1</code>');
    // Code blocks
    html = html.replace(/```(\w*)\n([\s\S]*?)```/g, '<pre><code>$2</code></pre>');
    // Links
    html = html.replace(/\[([^\]]+)\]\(([^)]+)\)/g, '<a href="$2" target="_blank" rel="noopener">$1</a>');
    // Mentions
    html = html.replace(/@(\w+)/g, '<span class="cp-mention" style="color:var(--cp-blue);cursor:pointer">@$1</span>');
    // Line breaks
    html = html.replace(/\n/g, '<br>');
    return html;
  }

  /* ── Optimistic updates ─────────────────────────────────────── */
  function optimisticUpdate(postId, changes) {
    const post = state.posts.find(p => p.id == postId);
    if (post) {
      Object.assign(post, changes);
      const el = document.querySelector(`[data-post-id="${postId}"]`);
      if (el) {
        if (changes.liked !== undefined) {
          const btn = el.querySelector('[data-action="like"]');
          if (btn) {
            btn.classList.toggle('cp-action--active', !!changes.liked);
            btn.querySelector('.cp-action__count').textContent = changes.like_count;
          }
        }
        if (changes.saved !== undefined) {
          const btn = el.querySelector('[data-action="save"]');
          if (btn) {
            btn.classList.toggle('cp-action--active', !!changes.saved);
            btn.querySelector('.cp-action__text').textContent = changes.saved ? 'Guardado' : 'Guardar';
          }
        }
      }
    }
  }

  /* ── Render: Post ───────────────────────────────────────────── */
  function renderPost(post, comments = []) {
    const tags = (post.tags || '').split(',').filter(Boolean);
    const media = post.media ? (typeof post.media === 'string' ? JSON.parse(post.media) : post.media) : null;
    const isOwner = post.user_id == state.currentUserId;

    let mediaHtml = '';
    if (media && media.length > 0) {
      if (media.length === 1) {
        const m = media[0];
        if (m.type === 'video') {
          mediaHtml = `<div class="cp-post__video"><video src="${esc(m.url)}" controls preload="metadata"></video></div>`;
        } else {
          mediaHtml = `<div class="cp-post__media"><img src="${esc(m.url)}" alt="${esc(m.alt || '')}" loading="lazy" onclick="CP.openLightbox('${esc(m.url)}')"></div>`;
        }
      } else {
        // Carousel
        const dots = media.map((_, i) => `<div class="cp-post__carousel-dot ${i === 0 ? 'cp-post__carousel-dot--active' : ''}" data-index="${i}"></div>`).join('');
        const slides = media.map(m => {
          if (m.type === 'video') return `<video src="${esc(m.url)}" controls preload="metadata" style="flex:0 0 100%;scroll-snap-align:start"></video>`;
          return `<img src="${esc(m.url)}" alt="${esc(m.alt || '')}" loading="lazy" onclick="CP.openLightbox('${esc(m.url)}')">`;
        }).join('');
        mediaHtml = `<div class="cp-post__carousel"><button class="cp-post__carousel-nav cp-post__carousel-nav--prev" onclick="CP.carouselNav(this,-1)">‹</button><div class="cp-post__carousel-track">${slides}</div><button class="cp-post__carousel-nav cp-post__carousel-nav--next" onclick="CP.carouselNav(this,1)">›</button><div class="cp-post__carousel-dots">${dots}</div></div>`;
      }
    }

    let pollHtml = '';
    if (post.poll_data) {
      const poll = typeof post.poll_data === 'string' ? JSON.parse(post.poll_data) : post.poll_data;
      const totalVotes = poll.total_votes || 0;
      const options = (poll.options || []).map((opt, i) => {
        const votes = poll.votes ? Object.values(poll.votes).filter(v => v === i).length : 0;
        const pct = totalVotes > 0 ? Math.round((votes / totalVotes) * 100) : 0;
        const voted = poll.user_vote === i;
        return `<div class="cp-poll__option ${voted ? 'cp-poll__option--voted' : ''}" onclick="CP.votePoll(${post.id},${i})"><div class="cp-poll__option-bar" style="width:${voted ? pct : 0}%"></div><div class="cp-poll__option-text"><span>${esc(opt)}</span>${totalVotes > 0 ? `<span class="cp-poll__option-pct">${pct}%</span>` : ''}</div></div>`;
      }).join('');
      pollHtml = `<div class="cp-poll"><div class="cp-poll__question">${esc(poll.question || '')}</div><div class="cp-poll__options">${options}</div><div class="cp-poll__meta"><span>${totalVotes} voto${totalVotes !== 1 ? 's' : ''}</span>${poll.ends_at ? `<span>Termina ${timeAgo(poll.ends_at)}</span>` : ''}</div></div>`;
    }

    let quoteHtml = '';
    if (post.quote_parent_id && post.quoted_post) {
      const qp = post.quoted_post;
      quoteHtml = `<div class="cp-quote-original"><div class="cp-quote-original__author">@${esc(qp.author_name)}</div><div class="cp-quote-original__body">${esc(qp.post_body)}</div></div>`;
    }

    const tagsHtml = tags.length ? `<div class="cp-tags">${tags.map(t => `<span class="cp-tag" onclick="CP.searchTag('${esc(t)}')">#${esc(t)}</span>`).join('')}</div>` : '';
    const commentHtml = renderComments(comments, post.id);

    return `<article class="cp-post ${post.is_pinned ? 'cp-post--pinned' : ''}" data-post-id="${post.id}">
  <div class="cp-post__header">
    <div class="cp-post__avatar" onclick="CP.viewProfile(${post.user_id})">${initials(post.author_name)}</div>
    <div class="cp-post__meta">
      <div class="cp-post__author" onclick="CP.viewProfile(${post.user_id})">${esc(post.author_name)}${post.is_verified ? '<span class="cp-post__verified">✓</span>' : ''}</div>
      <div class="cp-post__time">${timeAgo(post.created_at)}${post.is_edited ? ' · editado' : ''}</div>
    </div>
    <span class="cp-post__badge">${esc(post.subject || 'General')} · ${categoryLabel(post.category)}</span>
    ${isOwner ? `<button class="cp-post__more" onclick="CP.postMenu(${post.id})" title="Más opciones">⋯</button>` : ''}
  </div>
  ${post.post_title ? `<h3 class="cp-post__title">${esc(post.post_title)}</h3>` : ''}
  <div class="cp-post__body">${renderMarkdown(post.post_body)}</div>
  ${mediaHtml}
  ${pollHtml}
  ${quoteHtml}
  ${tagsHtml}
  <div class="cp-post__actions">
    <button class="cp-action cp-action--like ${Number(post.liked) ? 'cp-action--active' : ''}" data-action="like" onclick="CP.toggleLike(${post.id})">
      <span class="cp-action__icon">${Number(post.liked) ? '❤️' : '♡'}</span>
      <span class="cp-action__count">${Number(post.like_count) || 0}</span>
      <span class="cp-action__text">Apoyar</span>
    </button>
    <button class="cp-action" onclick="CP.focusComment(${post.id})">
      <span class="cp-action__icon">💬</span>
      <span>${Number(post.comment_count) || 0}</span>
      <span>Responder</span>
    </button>
    <button class="cp-action cp-action--save ${Number(post.saved) ? 'cp-action--active' : ''}" data-action="save" onclick="CP.toggleSave(${post.id})">
      <span class="cp-action__icon">${Number(post.saved) ? '🔖' : '▱'}</span>
      <span class="cp-action__text">${Number(post.saved) ? 'Guardado' : 'Guardar'}</span>
    </button>
    <button class="cp-action" onclick="CP.sharePost(${post.id})">
      <span class="cp-action__icon">↗</span>
      <span>Compartir</span>
    </button>
  </div>
  ${renderReactions(post)}
  ${commentHtml}
  <form class="cp-comment-form" onsubmit="return CP.submitComment(event,${post.id})">
    <input class="cp-comment-form__input" id="comment-${post.id}" maxlength="1000" placeholder="Aporta una respuesta...">
    <button class="cp-comment-form__submit" type="submit">↑</button>
  </form>
</article>`;
  }

  function renderReactions(post) {
    const reactions = ['like:👍', 'love:❤️', 'fire:🔥', 'mind:🤯', 'idea:💡'];
    const myReaction = post.my_reaction || '';
    const reactionCounts = {};
    if (post.reactions) {
      post.reactions.split(',').forEach(r => {
        reactionCounts[r] = (reactionCounts[r] || 0) + 1;
      });
    }
    const buttons = reactions.map(([key, icon]) => {
      const count = reactionCounts[key] || 0;
      const isActive = myReaction === key;
      return `<button class="cp-reaction ${isActive ? 'cp-reaction--active' : ''}" onclick="CP.react(${post.id},'${key}')">${icon}${count > 0 ? `<span class="cp-reaction__count">${count}</span>` : ''}</button>`;
    }).join('');
    return `<div class="cp-reactions">${buttons}</div>`;
  }

  function renderComments(comments, postId) {
    if (!comments || !comments.length) return '';
    // Separate top-level and replies
    const topLevel = comments.filter(c => !c.parent_id);
    const replies = comments.filter(c => c.parent_id);
    const replyMap = {};
    replies.forEach(r => {
      if (!replyMap[r.parent_id]) replyMap[r.parent_id] = [];
      replyMap[r.parent_id].push(r);
    });

    function renderComment(comment, isReply = false) {
      const childReplies = replyMap[comment.id] || [];
      return `<div class="cp-comment ${isReply ? '' : ''}">
  <div class="cp-comment__avatar" onclick="CP.viewProfile(${comment.user_id})">${initials(comment.author_name)}</div>
  <div class="cp-comment__body">
    <div class="cp-comment__header">
      <span class="cp-comment__author" onclick="CP.viewProfile(${comment.user_id})">${esc(comment.author_name)}</span>
      <span class="cp-comment__time">${timeAgo(comment.created_at)}</span>
    </div>
    ${comment.reply_to_user_name ? `<div class="cp-comment__reply-to">↗ ${esc(comment.reply_to_user_name)}</div>` : ''}
    <div class="cp-comment__text">${renderMarkdown(comment.comment_body)}</div>
    <div class="cp-comment__actions">
      <span class="cp-comment__action" onclick="CP.replyToComment(${postId},${comment.id},'${esc(comment.author_name)}')">Responder</span>
      ${comment.user_id == state.currentUserId ? `<span class="cp-comment__action" onclick="CP.deleteComment(${comment.id})">Eliminar</span>` : ''}
    </div>
    ${childReplies.length ? `<div class="cp-comment__replies">${childReplies.map(r => renderComment(r, true)).join('')}</div>` : ''}
  </div>
</div>`;
    }

    return `<div class="cp-comments">${topLevel.map(c => renderComment(c)).join('')}</div>`;
  }

  /* ── Render: Stories ────────────────────────────────────────── */
  function renderStories(stories) {
    const strip = $('cp-stories');
    if (!strip) return;
    let html = '<button class="cp-story cp-story--add" id="cp-add-story" type="button">Historia</button>';
    stories.forEach(story => {
      html += `<button class="cp-story" type="button" onclick="CP.viewStory(${story.id})" title="${esc(story.story_text)}">
        <div class="cp-story__author">${esc(story.author_name)}</div>
        <div class="cp-story__text">${esc(story.story_text)}</div>
      </button>`;
    });
    strip.innerHTML = html;
    $('cp-add-story')?.addEventListener('click', createStory);
  }

  /* ── Render: Notifications ──────────────────────────────────── */
  function renderNotifications(notifications) {
    const list = $('cp-notif-list');
    if (!list) return;
    if (!notifications.length) {
      list.innerHTML = '<div class="cp-empty"><div class="cp-empty__icon">🔔</div><div class="cp-empty__text">Sin actividad nueva</div></div>';
      return;
    }
    list.innerHTML = notifications.map(n => {
      const iconMap = { like: '❤️', comment: '💬', reply: '💬', follow: '👤', mention: '@', quote: '🔀', story_like: '❤️' };
      const iconClass = n.type || 'comment';
      return `<div class="cp-notif-item ${n.is_read ? '' : 'cp-notif-item--unread'}">
        <div class="cp-notif-item__icon cp-notif-item__icon--${iconClass}">${iconMap[n.type] || '🔔'}</div>
        <div>
          <div class="cp-notif-item__message">${esc(n.message)}</div>
          <div class="cp-notif-item__time">${timeAgo(n.created_at)}</div>
        </div>
      </div>`;
    }).join('');
  }

  /* ── Render: Trending (sidebar) ─────────────────────────────── */
  function renderTrending(hashtags) {
    const container = $('cp-trending-list');
    if (!container || !hashtags) return;
    container.innerHTML = hashtags.slice(0, 8).map(h => `
      <div class="cp-trending__item" onclick="CP.searchTag('${esc(h.tag)}')">
        <span class="cp-trending__tag">#${esc(h.tag)}</span>
        <span class="cp-trending__count">${h.post_count} posts</span>
      </div>
    `).join('');
  }

  /* ── Render: Who to follow (sidebar) ────────────────────────── */
  function renderFollowSuggestions(users) {
    const container = $('cp-follow-suggestions');
    if (!container || !users) return;
    container.innerHTML = users.map(u => `
      <div class="cp-follow-suggestion">
        <div class="cp-follow-suggestion__avatar" onclick="CP.viewProfile(${u.user_id})">${initials(u.display_name || u.author_name)}</div>
        <div class="cp-follow-suggestion__info">
          <div class="cp-follow-suggestion__name" onclick="CP.viewProfile(${u.user_id})">${esc(u.display_name || u.author_name)}</div>
          <div class="cp-follow-suggestion__sub">${u.post_count || 0} publicaciones</div>
        </div>
        <button class="cp-follow-suggestion__btn ${u.is_following ? 'cp-follow-suggestion__btn--following' : ''}" onclick="CP.toggleFollow(${u.user_id},this)">${u.is_following ? 'Siguiendo' : 'Seguir'}</button>
      </div>
    `).join('');
  }

  /* ── Load Feed ──────────────────────────────────────────────── */
  async function loadFeed(force = false, append = false) {
    if (state.loading) return;
    state.loading = true;

    const params = {
      category: state.category,
      subject: state.subject,
      mode: state.mode,
      sort: state.sort,
      search: state.search,
      limit: PAGE_SIZE,
    };
    if (append && state.cursor) params.cursor = state.cursor;

    const data = await apiGet(params);
    state.loading = false;

    if (!data.ok) {
      if (state.firstLoad) {
        $('cp-feed').innerHTML = '<div class="cp-empty"><div class="cp-empty__icon">📡</div><div class="cp-empty__text">No se pudo conectar con la comunidad.</div></div>';
      }
      return;
    }

    state.currentUserId = data.current_user_id;
    state.latestId = data.latest_id;
    state.nextCursor = data.next_cursor;
    state.firstLoad = false;

    // Check for new posts banner
    if (!append && !force && data.latest_id > state.latestId && state.latestId > 0) {
      $('cp-new-banner')?.classList.add('visible');
      state.loading = false;
      return;
    }

    state.posts = data.posts;

    const html = data.posts.map(post => renderPost(post, data.comments?.[post.id] || [])).join('');
    if (append) {
      $('cp-feed').insertAdjacentHTML('beforeend', html);
    } else {
      $('cp-feed').innerHTML = html || '<div class="cp-empty"><div class="cp-empty__icon">📝</div><div class="cp-empty__text">Todavía no hay publicaciones con estos filtros.</div></div>';
    }

    // Update load more button
    const loadMoreBtn = $('cp-load-more');
    if (loadMoreBtn) {
      loadMoreBtn.disabled = !state.nextCursor;
      loadMoreBtn.innerHTML = state.nextCursor ? 'Cargar más' : 'No hay más publicaciones';
    }
  }

  /* ── Load Stories ───────────────────────────────────────────── */
  async function loadStories() {
    const data = await apiGet({ view: 'stories' });
    if (data.ok) {
      state.stories = data.stories || [];
      renderStories(state.stories);
    }
  }

  /* ── Load Notifications ─────────────────────────────────────── */
  async function loadNotifications() {
    const data = await apiGet({ view: 'notifications' });
    if (data.ok) {
      state.notifications = data.notifications || [];
      state.unreadCount = data.unread || 0;
      renderNotifications(state.notifications);
      const badge = $('cp-notif-badge');
      if (badge) {
        badge.textContent = state.unreadCount;
        badge.style.display = state.unreadCount > 0 ? 'flex' : 'none';
      }
    }
  }

  /* ── Load Sidebar Data ──────────────────────────────────────── */
  async function loadSidebar() {
    const data = await apiGet({ view: 'sidebar', current_user_id: state.currentUserId });
    if (data.ok) {
      renderTrending(data.hashtags);
      renderFollowSuggestions(data.suggested_users);
    }
  }

  /* ── Create Story ───────────────────────────────────────────── */
  async function createStory() {
    const text = prompt('Comparte una historia breve (280 caracteres):');
    if (!text || !text.trim()) return;
    const result = await api('create_story', { story_text: text.trim(), subject: state.subject || 'General' });
    if (!result.ok) toast(result.error || 'No se pudo crear la historia');
    else { toast('Historia publicada por 24 horas'); loadStories(); }
  }

  /* ── Public API (window.CP) ─────────────────────────────────── */
  window.CP = {
    // Like with optimistic update
    async toggleLike(postId) {
      optimisticUpdate(postId, {
        liked: !state.posts.find(p => p.id == postId)?.liked,
        like_count: (state.posts.find(p => p.id == postId)?.like_count || 0) + (state.posts.find(p => p.id == postId)?.liked ? -1 : 1),
      });
      const result = await api('toggle_like', { post_id: postId });
      if (!result.ok) {
        toast(result.error || 'Inicia sesión');
        loadFeed(true);
      }
    },

    // Save with optimistic update
    async toggleSave(postId) {
      optimisticUpdate(postId, {
        saved: !state.posts.find(p => p.id == postId)?.saved,
      });
      const result = await api('toggle_save', { post_id: postId });
      if (!result.ok) { toast(result.error || 'Inicia sesión'); loadFeed(true); }
    },

    // React
    async react(postId, reaction) {
      const result = await api('react', { post_id: postId, reaction });
      if (result.ok) { toast('Reacción guardada'); loadFeed(true); }
      else toast(result.error || 'No se pudo reaccionar');
    },

    // Comment
    async submitComment(event, postId) {
      event.preventDefault();
      const input = $(`comment-${postId}`);
      if (!input?.value.trim()) return false;
      const result = await api('create_comment', { post_id: postId, comment_body: input.value.trim() });
      if (!result.ok) toast(result.error || 'No se pudo responder');
      else { input.value = ''; loadFeed(true); }
      return false;
    },

    // Reply to comment
    replyToComment(postId, commentId, authorName) {
      const input = $(`comment-${postId}`);
      if (input) {
        input.focus();
        input.placeholder = `Respondiendo a @${authorName}...`;
        input.dataset.parentId = commentId;
        input.dataset.replyTo = authorName;
      }
    },

    // Delete comment
    async deleteComment(commentId) {
      if (!confirm('¿Eliminar este comentario?')) return;
      const result = await api('delete_comment', { comment_id: commentId });
      if (result.ok) { toast('Comentario eliminado'); loadFeed(true); }
    },

    // Follow
    async toggleFollow(userId, btn) {
      const result = await api('toggle_follow', { user_id: userId });
      if (result.ok) {
        if (btn) {
          btn.classList.toggle('cp-follow-suggestion__btn--following', result.active);
          btn.textContent = result.active ? 'Siguiendo' : 'Seguir';
        }
      } else toast(result.error || 'No se pudo seguir');
    },

    // Delete post
    async deletePost(postId) {
      if (!confirm('¿Eliminar esta publicación?')) return;
      const result = await api('delete_post', { post_id: postId });
      if (result.ok) { toast('Publicación eliminada'); loadFeed(true); }
      else toast(result.error || 'No autorizado');
    },

    // Post menu
    postMenu(postId) {
      const post = state.posts.find(p => p.id == postId);
      if (!post) return;
      const actions = [];
      if (post.user_id == state.currentUserId) actions.push({ label: '🗑️ Eliminar', action: () => this.deletePost(postId) });
      actions.push({ label: '🚩 Reportar', action: () => this.reportPost(postId) });
      actions.push({ label: '📋 Copiar link', action: () => { navigator.clipboard.writeText(window.location.href + '#post-' + postId); toast('Link copiado'); } });
      // Simple context menu
      const existing = document.querySelector('.cp-context-menu');
      if (existing) existing.remove();
      const menu = document.createElement('div');
      menu.className = 'cp-context-menu';
      menu.style.cssText = 'position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);z-index:200;background:var(--cp-panel);border:1px solid var(--cp-line);border-radius:var(--cp-radius-lg);padding:8px;min-width:200px;box-shadow:var(--cp-shadow-lg);';
      actions.forEach(a => {
        const btn = document.createElement('button');
        btn.style.cssText = 'display:block;width:100%;padding:10px 14px;text-align:left;border-radius:var(--cp-radius-sm);font-size:13px;color:var(--cp-ink);transition:background .15s;';
        btn.textContent = a.label;
        btn.onmouseover = () => btn.style.background = 'var(--cp-blue-dim)';
        btn.onmouseout = () => btn.style.background = 'transparent';
        btn.onclick = () => { menu.remove(); a.action(); };
        menu.appendChild(btn);
      });
      document.body.appendChild(menu);
      setTimeout(() => {
        const close = (e) => { if (!menu.contains(e.target)) { menu.remove(); document.removeEventListener('click', close); } };
        document.addEventListener('click', close);
      }, 10);
    },

    // Report
    async reportPost(postId) {
      const reason = prompt('¿Por qué reportas esta publicación?\n\nOpciones: spam, acoso, contenido inapropiado, otro');
      if (!reason) return;
      const result = await api('report', { target_type: 'post', target_id: postId, reason });
      if (result.ok) toast('Reporte enviado. Gracias.');
      else toast(result.error || 'No se pudo reportar');
    },

    // Share
    sharePost(postId) {
      if (navigator.share) {
        navigator.share({ title: 'LC-PULSO', url: window.location.href + '#post-' + postId });
      } else {
        navigator.clipboard.writeText(window.location.href + '#post-' + postId);
        toast('Link copiado');
      }
    },

    // Focus comment
    focusComment(postId) {
      const input = $(`comment-${postId}`);
      if (input) input.focus();
    },

    // Search tag
    searchTag(tag) {
      $('cp-search').value = '#' + tag;
      state.search = '#' + tag;
      state.cursor = 0;
      state.firstLoad = true;
      loadFeed(true);
    },

    // View profile (navigate)
    viewProfile(userId) {
      if (userId) window.location.href = `community_profile.php?id=${userId}`;
    },

    // View story
    viewStory(storyId) {
      const story = state.stories.find(s => s.id == storyId);
      if (!story) return;
      alert(`Historia de ${story.author_name}:\n\n${story.story_text}`);
    },

    // Lightbox
    openLightbox(url) {
      const lb = document.createElement('div');
      lb.className = 'cp-lightbox';
      lb.innerHTML = `<div class="cp-lightbox__close" onclick="this.parentElement.remove()">✕</div><img src="${url}">`;
      lb.onclick = (e) => { if (e.target === lb) lb.remove(); };
      document.body.appendChild(lb);
    },

    // Carousel nav
    carouselNav(btn, dir) {
      const track = btn.parentElement.querySelector('.cp-post__carousel-track');
      if (track) {
        track.scrollBy({ left: dir * track.offsetWidth, behavior: 'smooth' });
        // Update dots
        const dots = btn.parentElement.querySelectorAll('.cp-post__carousel-dot');
        const index = Math.round(track.scrollLeft / track.offsetWidth);
        dots.forEach((d, i) => d.classList.toggle('cp-post__carousel-dot--active', i === index));
      }
    },

    // Vote poll
    async votePoll(postId, optionIndex) {
      const result = await api('vote_poll', { post_id: postId, option_index: optionIndex });
      if (result.ok) loadFeed(true);
      else toast(result.error || 'No se pudo votar');
    },

    // Toggle notifications panel
    toggleNotifications() {
      const panel = $('cp-notif-panel');
      if (panel) panel.classList.toggle('hidden');
    },

    // Toggle theme
    toggleTheme() {
      state.theme = state.theme === 'dark' ? 'light' : 'dark';
      document.documentElement.setAttribute('data-theme', state.theme);
      localStorage.setItem('cp-theme', state.theme);
    },

    // Navigate
    navigate(page) {
      window.location.href = page;
    },
  };

  /* ── Event Listeners ────────────────────────────────────────── */
  function initEvents() {
    // Post form
    $('cp-post-form')?.addEventListener('submit', async (e) => {
      e.preventDefault();
      const btn = $('cp-publish-btn');
      if (btn) btn.disabled = true;
      const data = {
        title: $('cp-post-title')?.value.trim() || '',
        body: $('cp-post-body')?.value.trim(),
        category: $('cp-post-category')?.value,
        subject: $('cp-post-subject')?.value,
        tags: $('cp-post-tags')?.value,
      };
      if (!data.body) { toast('Escribe algo para publicar'); if (btn) btn.disabled = false; return; }
      const result = await api('create_post', data);
      if (btn) btn.disabled = false;
      if (!result.ok) return toast(result.error || 'No se pudo publicar');
      $('cp-post-form').reset();
      toast('Publicación compartida');
      loadFeed(true);
    });

    // Category filters
    $$('[data-category]').forEach(btn => btn.addEventListener('click', () => {
      $$('[data-category]').forEach(b => b.classList.remove('cp-category--active'));
      btn.classList.add('cp-category--active');
      state.category = btn.dataset.category;
      state.cursor = 0;
      state.firstLoad = true;
      loadFeed(true);
    }));

    // Subject filters
    $$('[data-subject]').forEach(btn => btn.addEventListener('click', () => {
      $$('[data-subject]').forEach(b => b.classList.remove('cp-category--active'));
      btn.classList.add('cp-category--active');
      state.subject = btn.dataset.subject;
      state.cursor = 0;
      state.firstLoad = true;
      loadFeed(true);
    }));

    // Feed tabs
    $$('[data-mode]').forEach(btn => btn.addEventListener('click', () => {
      $$('[data-mode]').forEach(b => b.classList.remove('cp-tab--active'));
      btn.classList.add('cp-tab--active');
      state.mode = btn.dataset.mode;
      state.cursor = 0;
      state.firstLoad = true;
      loadFeed(true);
    }));

    // Sort
    $('cp-sort')?.addEventListener('change', (e) => {
      state.sort = e.target.value;
      state.cursor = 0;
      state.firstLoad = true;
      loadFeed(true);
    });

    // Search
    let searchTimeout;
    $('cp-search')?.addEventListener('input', (e) => {
      clearTimeout(searchTimeout);
      searchTimeout = setTimeout(() => {
        state.search = e.target.value.trim();
        state.cursor = 0;
        state.firstLoad = true;
        loadFeed(true);
      }, 300);
    });

    // Load more
    $('cp-load-more')?.addEventListener('click', async () => {
      if (!state.nextCursor || state.loadingMore) return;
      state.loadingMore = true;
      state.cursor = state.nextCursor;
      await loadFeed(false, true);
      state.loadingMore = false;
    });

    // New posts banner
    $('cp-new-banner')?.addEventListener('click', () => {
      $('cp-new-banner').classList.remove('visible');
      state.cursor = 0;
      state.firstLoad = true;
      loadFeed(true);
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Notification button
    $('cp-notif-btn')?.addEventListener('click', () => {
      CP.toggleNotifications();
    });

    // Close notification panel on outside click
    document.addEventListener('click', (e) => {
      const panel = $('cp-notif-panel');
      const btn = $('cp-notif-btn');
      if (panel && !panel.classList.contains('hidden') && !panel.contains(e.target) && !btn?.contains(e.target)) {
        panel.classList.add('hidden');
      }
    });

    // Infinite scroll
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting && state.nextCursor && !state.loadingMore) {
          state.loadingMore = true;
          state.cursor = state.nextCursor;
          loadFeed(false, true).then(() => { state.loadingMore = false; });
        }
      });
    }, { rootMargin: '200px' });
    const sentinel = $('cp-scroll-sentinel');
    if (sentinel) observer.observe(sentinel);

    // Pull to refresh
    let pullStartY = 0;
    let pulling = false;
    document.addEventListener('touchstart', (e) => {
      if (window.scrollY === 0) {
        pullStartY = e.touches[0].clientY;
        pulling = true;
      }
    }, { passive: true });
    document.addEventListener('touchmove', (e) => {
      if (!pulling) return;
      const diff = e.touches[0].clientY - pullStartY;
      if (diff > 60) {
        const indicator = $('cp-pull-indicator');
        if (indicator) indicator.classList.add('active');
      }
    }, { passive: true });
    document.addEventListener('touchend', async () => {
      if (!pulling) return;
      pulling = false;
      const indicator = $('cp-pull-indicator');
      if (indicator?.classList.contains('active')) {
        indicator.classList.add('spinning');
        state.cursor = 0;
        state.firstLoad = true;
        await loadFeed(true);
        indicator.classList.remove('active', 'spinning');
      }
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        $('cp-notif-panel')?.classList.add('hidden');
        document.querySelector('.cp-lightbox')?.remove();
        document.querySelector('.cp-context-menu')?.remove();
      }
    });

    // Theme
    document.documentElement.setAttribute('data-theme', state.theme);
  }

  /* ── Initialize ─────────────────────────────────────────────── */
  function init() {
    initEvents();
    loadFeed();
    loadStories();
    loadNotifications();
    loadSidebar();

    // Polling
    state.pollTimer = setInterval(() => loadFeed(), POLL_INTERVAL);
    state.notifTimer = setInterval(() => loadNotifications(), NOTIF_INTERVAL);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
