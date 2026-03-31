# Fix encoding on two specific lines in content.php
$file = 'c:\xampp\htdocs\LC-ADVANCE\src\content.php'
$content = [System.IO.File]::ReadAllText($file, [System.Text.Encoding]::UTF8)

# Fix line 571 — broken emoji scoring message
$bad1 = 'const msg = score===6?"' + [char]0xC3 + [char]0xB0 + [char]0x9F + [char]0x8F + [char]0x86 + ' ' + [char]0xC2 + [char]0xA1 + 'Perfecto!":score>=4?"' + [char]0xC3 + [char]0xB0 + [char]0x9F + [char]0x91 + [char]0x8D + ' Buen trabajo":"' + [char]0xC3 + [char]0xB0 + [char]0x9F + [char]0x93 + [char]0x98 + ' Revisa la teor' + [char]0xC3 + [char]0x83 + [char]0xC2 + [char]0xAD + 'a";'
$good1 = 'const msg = score===6?"Perfecto!":score>=4?"Buen trabajo":"Revisa la teoria";'

# Simpler: just replace the broken patterns using string matching
$content = $content -replace 'const msg = score===6\?"[^"]*!":score>=4\?"[^"]*":\"[^"]*";', 'const msg = score===6 ? "Perfecto!" : score>=4 ? "Buen trabajo" : "Revisa la teoria";'

# Fix the em-dash —
$content = $content -replace 'html \+= `</ul><p><strong>Puntaje: \${score}/6</strong> [^{]*\${msg}</p>`;', 'html += `</ul><p><strong>Puntaje: ${score}/6</strong> — ${msg}</p>`;'

[System.IO.File]::WriteAllText($file, $content, [System.Text.Encoding]::UTF8)
Write-Host "Encoding fix applied."
