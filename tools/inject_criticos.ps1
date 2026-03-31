# Inject content of tmp_criticos.html into src/content.php
$file = 'c:\xampp\htdocs\LC-ADVANCE\src\content.php'
$tmpFile = 'c:\xampp\htdocs\LC-ADVANCE\tmp_criticos.html'

$contentRaw = [System.IO.File]::ReadAllText($file, [System.Text.Encoding]::UTF8)
$newBlock = [System.IO.File]::ReadAllText($tmpFile, [System.Text.Encoding]::UTF8)

# Find markers
$startMarker = "'titulo'  => 'Puntos Críticos: Máximos y Mínimos Locales – Prueba de la Primera Derivada',"
$endMarker = "/* =====================================" # Start of quiz pool

$startIndex = $contentRaw.IndexOf($startMarker)
if ($startIndex -eq -1) { 
    Write-Host "Error: No se encontró el inicio de la lección."; exit 1 
}
$startIndex += $startMarker.Length

$endIndex = $contentRaw.IndexOf($endMarker, $startIndex)
if ($endIndex -eq -1) { 
    Write-Host "Error: No se encontró el fin de la lección."; exit 1 
}

$before = $contentRaw.Substring(0, $startIndex)
$after = $contentRaw.Substring($endIndex)

$finalContent = $before + "`n" + $newBlock + "`n" + $after
[System.IO.File]::WriteAllText($file, $finalContent, [System.Text.Encoding]::UTF8)
Write-Host "Lección Puntos Críticos INYECTADA exitosamente."
