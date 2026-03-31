# Remove inline <style> block from derivadas lesson (lines 253-937)
# and replace with single CSS reference comment

$file = 'c:\xampp\htdocs\LC-ADVANCE\src\content.php'
$lines = Get-Content $file -Encoding UTF8
Write-Host ("Total lines before: " + $lines.Count)

# Lines are 1-indexed in editor; array is 0-indexed
# Remove lines 253..937 (array indices 252..936) — the <style> block
$before  = $lines[0..251]          # lines 1-252 (indices 0-251)
$comment = '    <!-- CSS: assets/css/leccion-derivadas.css (cargado en leccion_detalle.php) -->'
$after   = $lines[937..($lines.Count - 1)]  # lines 938+ (index 937+)

$newLines = $before + $comment + $after
Write-Host ("Total lines after:  " + $newLines.Count)

$newContent = $newLines -join "`n"
[System.IO.File]::WriteAllText($file, $newContent, [System.Text.Encoding]::UTF8)
Write-Host "Done! Inline style block removed."
