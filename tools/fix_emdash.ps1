# Fix remaining em-dash encoding issue
$file = 'c:\xampp\htdocs\LC-ADVANCE\src\content.php'
$content = [System.IO.File]::ReadAllText($file, [System.Text.Encoding]::UTF8)

# The broken em-dash sequence caused by double-encoding
# Replace the entire broken line with clean version
$brokenLine = "html += ``</ul><p><strong>Puntaje: `${score}/6</strong> " + [char]0xE2 + [char]0x80 + [char]0x93 + " `${msg}</p>``;"
$fixedLine  = "html += ``</ul><p><strong>Puntaje: `${score}/6</strong> | `${msg}</p>``;"

# Use simple regex to fix
$content = $content -replace 'html \+= `<\/ul><p><strong>Puntaje: \$\{score\}\/6<\/strong> [^\`]*\$\{msg\}<\/p>`;', 'html += `</ul><p><strong>Puntaje: ${score}/6</strong> | ${msg}</p>`;'

[System.IO.File]::WriteAllText($file, $content, [System.Text.Encoding]::UTF8)
Write-Host "Em-dash fix done."
