<?php

function renderBlocks($blocks) {
    if (is_string($blocks)) $blocks = json_decode($blocks, true) ?: [];
    if (!is_array($blocks)) return '<p style="color:var(--muted)">Sin contenido.</p>';

    $html = '';
    foreach ($blocks as $b) {
        $tipo = $b['tipo'] ?? 'text';
        $data = $b['data'] ?? [];
        $id = 'block-' . ($b['id'] ?? uniqid());
        $style = '';
        if (!empty($data['bg'])) $style .= 'background:' . htmlspecialchars($data['bg']) . ';';
        if (!empty($data['textColor'])) $style .= 'color:' . htmlspecialchars($data['textColor']) . ';';
        if (!empty($data['padding'])) $style .= 'padding:' . htmlspecialchars($data['padding']) . ';';
        if (!empty($data['textAlign'])) $style .= 'text-align:' . htmlspecialchars($data['textAlign']) . ';';
        $style_attr = $style ? ' style="' . $style . '"' : '';

        switch ($tipo) {
            case 'heading':
                $tag = $data['level'] ?? 'h2';
                $html .= "<$tag id=\"$id\"$style_attr>" . nl2br(htmlspecialchars($data['text'] ?? '')) . "</$tag>\n";
                break;

            case 'text':
                $html .= '<p id="' . $id . '"' . $style_attr . '>' . nl2br(htmlspecialchars($data['text'] ?? '')) . "</p>\n";
                break;

            case 'image':
                $src = htmlspecialchars($data['src'] ?? '');
                $alt = htmlspecialchars($data['alt'] ?? '');
                $cap = htmlspecialchars($data['caption'] ?? '');
                $html .= '<figure id="' . $id . '"' . $style_attr . '>';
                if ($src) $html .= '<img src="' . $src . '" alt="' . $alt . '" style="max-width:100%;border-radius:8px">';
                if ($cap) $html .= '<figcaption style="text-align:center;font-size:12px;color:var(--muted);margin-top:6px">' . $cap . '</figcaption>';
                $html .= "</figure>\n";
                break;

            case 'video':
                $url = htmlspecialchars($data['url'] ?? '');
                $html .= '<div id="' . $id . '" class="video-wrapper" style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;border-radius:8px;margin:12px 0"' . $style_attr . '>';
                if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
                    preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $m);
                    $vid = $m[1] ?? '';
                    if ($vid) $html .= '<iframe src="https://www.youtube.com/embed/' . $vid . '" style="position:absolute;top:0;left:0;width:100%;height:100%;border:0" allowfullscreen></iframe>';
                } else {
                    $html .= '<iframe src="' . $url . '" style="position:absolute;top:0;left:0;width:100%;height:100%;border:0" allowfullscreen></iframe>';
                }
                $html .= "</div>\n";
                break;

            case 'list':
                $items = $data['items'] ?? [];
                $tag = ($data['ordered'] ?? false) ? 'ol' : 'ul';
                $html .= "<$tag id=\"$id\"$style_attr>\n";
                foreach ($items as $item) {
                    $html .= '  <li>' . htmlspecialchars($item) . "</li>\n";
                }
                $html .= "</$tag>\n";
                break;

            case 'table':
                $headers = $data['headers'] ?? [];
                $rows = $data['rows'] ?? [];
                $html .= '<div style="overflow-x:auto"><table id="' . $id . '" class="preview-table"' . $style_attr . '>';
                if ($headers) {
                    $html .= '<thead><tr>';
                    foreach ($headers as $h) $html .= '<th>' . htmlspecialchars($h) . '</th>';
                    $html .= '</tr></thead>';
                }
                $html .= '<tbody>';
                foreach ($rows as $row) {
                    $html .= '<tr>';
                    foreach ($row as $cell) $html .= '<td>' . htmlspecialchars($cell) . '</td>';
                    $html .= '</tr>';
                }
                $html .= '</tbody></table></div>' . "\n";
                break;

            case 'card':
                $icon = htmlspecialchars($data['icon'] ?? '');
                $title = htmlspecialchars($data['title'] ?? '');
                $text = htmlspecialchars($data['text'] ?? '');
                $color = $data['color'] ?? 'var(--cyan)';
                $html .= '<div id="' . $id . '" class="info-card" style="padding:16px;background:var(--surface2);border-radius:12px;border-left:4px solid ' . $color . ';margin:12px 0"' . $style_attr . '>';
                if ($icon) $html .= '<div style="font-size:28px;margin-bottom:6px">' . $icon . '</div>';
                if ($title) $html .= '<strong style="color:' . $color . '">' . $title . '</strong>';
                if ($text) $html .= '<p style="margin:4px 0 0;color:var(--muted);font-size:14px">' . nl2br($text) . '</p>';
                $html .= "</div>\n";
                break;

            case 'alert':
                $type = $data['type'] ?? 'info';
                $text = htmlspecialchars($data['text'] ?? '');
                $colors = ['info' => 'var(--cyan)', 'success' => 'var(--green)', 'warning' => 'var(--yellow)', 'danger' => 'var(--red)'];
                $icons = ['info' => 'ℹ️', 'success' => '✅', 'warning' => '⚠️', 'danger' => '🚨'];
                $c = $colors[$type] ?? 'var(--cyan)';
                $html .= '<div id="' . $id . '" class="alert alert-' . $type . '" style="padding:12px 16px;border-radius:8px;margin:12px 0;font-size:14px;background:' . $c . '15;border:1px solid ' . $c . '35;color:var(--text)"' . $style_attr . '>';
                $html .= ($icons[$type] ?? '') . ' ' . nl2br($text);
                $html .= "</div>\n";
                break;

            case 'divider':
                $html .= '<hr id="' . $id . '" style="border:none;border-top:1px solid var(--border);margin:20px 0"' . $style_attr . ">\n";
                break;

            case 'columns':
                $cols = $data['columns'] ?? [];
                $html .= '<div id="' . $id . '" style="display:grid;grid-template-columns:repeat(' . count($cols) . ',1fr);gap:16px;margin:12px 0"' . $style_attr . ">\n";
                foreach ($cols as $col) {
                    $html .= '<div style="padding:12px;background:var(--surface);border-radius:8px;border:1px solid var(--border)">';
                    $html .= renderBlocks($col['blocks'] ?? []);
                    $html .= "</div>\n";
                }
                $html .= "</div>\n";
                break;

            case 'quiz':
                $questions = $data['questions'] ?? [];
                $html .= '<div id="' . $id . '" class="quiz-preview" style="margin:16px 0"' . $style_attr . '>';
                foreach ($questions as $qi => $q) {
                    $qtext = htmlspecialchars($q['pregunta'] ?? '');
                    $opts = $q['opciones'] ?? $q['options'] ?? [];
                    $correcta = htmlspecialchars($q['correcta'] ?? '');
                    $html .= '<div style="padding:14px;background:var(--surface2);border-radius:8px;margin-bottom:10px;border:1px solid var(--border)">';
                    $html .= '<div style="font-weight:600;margin-bottom:8px;font-size:14px">' . ($qi+1) . '. ' . $qtext . '</div>';
                    foreach ($opts as $oi => $opt) {
                        $is_correct = $opt === $correcta || (is_string($opt) && trim($opt) === trim($correcta));
                        $html .= '<label style="display:block;padding:6px 10px;margin:4px 0;border-radius:6px;background:' . ($is_correct ? 'var(--green)20' : 'var(--surface)') . ';border:1px solid ' . ($is_correct ? 'var(--green)40' : 'var(--border)') . ';cursor:default;font-size:13px">';
                        $html .= '<input type="radio" disabled' . ($is_correct ? ' checked' : '') . ' style="margin-right:8px">';
                        $html .= htmlspecialchars($opt);
                        if ($is_correct) $html .= ' ✅';
                        $html .= '</label>';
                    }
                    $html .= '</div>';
                }
                $html .= "</div>\n";
                break;

            case 'html':
                $html .= '<div id="' . $id . '"' . $style_attr . '>' . ($data['html'] ?? '') . "</div>\n";
                break;
            default:
                $html .= '<div id="' . $id . '"' . $style_attr . '>' . htmlspecialchars($data['text'] ?? '') . "</div>\n";
        }
    }
    return $html;
}

/**
 * Parse raw HTML content into an array of block elements for the builder.
 * Each top-level element becomes a separate block (heading, text, image, etc.).
 */
function htmlToBlocks($html) {
    if (empty(trim($html))) return [];

    $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML('<html><body>' . $html . '</body></html>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    libxml_clear_errors();

    $body = $dom->getElementsByTagName('body')->item(0);
    if (!$body) return [['id' => 'b0', 'tipo' => 'html', 'data' => ['html' => $html]]];

    // If there's a single root div, unwrap to get its children
    $children = [];
    /** @var DOMElement $child */
    foreach ($body->childNodes as $child) {
        if ($child->nodeType === XML_ELEMENT_NODE) {
            $children[] = $child;
        }
    }
    if (count($children) === 1 && $children[0]->nodeName === 'div') {
        $wrapper = $children[0];
        $inner = [];
        foreach ($wrapper->childNodes as $c) {
            if ($c->nodeType === XML_ELEMENT_NODE) {
                $inner[] = $c;
            }
        }
        if (count($inner) > 1) {
            $children = $inner;
        }
    }

    $blocks = [];
    $idCounter = 0;

    foreach ($children as $el) {
        $tag = $el->nodeName;
        $innerHtml = domInnerHtml($el);

        switch ($tag) {
            case 'h1': case 'h2': case 'h3': case 'h4': case 'h5': case 'h6':
                $blocks[] = [
                    'id'   => 'b' . ($idCounter++),
                    'tipo' => 'heading',
                    'data' => [
                        'level' => (int) substr($tag, 1),
                        'text'  => strip_tags($innerHtml)
                    ]
                ];
                break;

            case 'p':
                $blocks[] = [
                    'id'   => 'b' . ($idCounter++),
                    'tipo' => 'text',
                    'data' => ['text' => $innerHtml]
                ];
                break;

            case 'img':
                $src = $el->getAttribute('src');
                $alt = $el->getAttribute('alt');
                $blocks[] = [
                    'id'   => 'b' . ($idCounter++),
                    'tipo' => 'image',
                    'data' => ['src' => $src, 'alt' => $alt, 'caption' => '']
                ];
                break;

            case 'ul': case 'ol':
                $items = [];
                foreach ($el->getElementsByTagName('li') as $li) {
                    $items[] = strip_tags(domInnerHtml($li));
                }
                $blocks[] = [
                    'id'   => 'b' . ($idCounter++),
                    'tipo' => 'list',
                    'data' => [
                        'items'   => $items,
                        'ordered' => ($tag === 'ol')
                    ]
                ];
                break;

            case 'table':
                $headers = [];
                $rows = [];
                $trs = $el->getElementsByTagName('tr');
                $first = true;
                foreach ($trs as $tr) {
                    $cells = [];
                    foreach ($tr->childNodes as $td) {
                        if ($td->nodeType === XML_ELEMENT_NODE && in_array($td->nodeName, ['th','td'])) {
                            $cells[] = strip_tags(domInnerHtml($td));
                        }
                    }
                    if ($first && $el->getElementsByTagName('th')->length > 0) {
                        $headers = $cells;
                        $first = false;
                    } else {
                        $rows[] = $cells;
                    }
                }
                $blocks[] = [
                    'id'   => 'b' . ($idCounter++),
                    'tipo' => 'table',
                    'data' => ['headers' => $headers, 'rows' => $rows]
                ];
                break;

            case 'hr':
                $blocks[] = [
                    'id'   => 'b' . ($idCounter++),
                    'tipo' => 'divider',
                    'data' => []
                ];
                break;

            case 'figure':
                $imgs = $el->getElementsByTagName('img');
                if ($imgs->length > 0) {
                    $img = $imgs->item(0);
                    $src = $img->getAttribute('src');
                    $alt = $img->getAttribute('alt');
                    $figcaption = $el->getElementsByTagName('figcaption');
                    $caption = $figcaption->length > 0 ? $figcaption->item(0)->textContent : '';
                    $blocks[] = [
                        'id'   => 'b' . ($idCounter++),
                        'tipo' => 'image',
                        'data' => ['src' => $src, 'alt' => $alt, 'caption' => trim($caption)]
                    ];
                } else {
                    $blocks[] = [
                        'id'   => 'b' . ($idCounter++),
                        'tipo' => 'html',
                        'data' => ['html' => $el->ownerDocument->saveHTML($el)]
                    ];
                }
                break;

            default:
                $blocks[] = [
                    'id'   => 'b' . ($idCounter++),
                    'tipo' => 'html',
                    'data' => ['html' => $el->ownerDocument->saveHTML($el)]
                ];
                break;
        }
    }

    return $blocks;
}

function domInnerHtml($el) {
    $html = '';
    foreach ($el->childNodes as $child) {
        $html .= $el->ownerDocument->saveHTML($child);
    }
    return $html;
}
