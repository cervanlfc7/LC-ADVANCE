<?php
require_once __DIR__ . '/../src/Config/config.php';
requireLogin(true);
$active_challenge = $_GET['challenge'] ?? 'prog-sum-array';
$challenges = require __DIR__ . '/../src/Config/challenges.php';
if (!isset($challenges[$active_challenge])) {
    $active_challenge = 'prog-sum-array';
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Test Lab</title>
</head>
<body>
<h1>Test</h1>
<script>
var challenges = <?= json_encode($challenges) ?>;
var currentChallenge = '<?= $active_challenge ?>';
</script>
<script>
// Test function
function test() { return 1; }
</script>
</body>
</html>