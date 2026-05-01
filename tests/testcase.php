<?php
class TestCase {
    private $passed = 0; private $failed = 0;
    public function assertEquals($e, $a, $m = '') {
        if ($e === $a) { $this->passed++; return true; }
        $this->failed++;
        $l = debug_backtrace(DEBUG_BACKTRACE_IGNORE_AGS, 3)[2] ?? [];
        echo "  FAIL [" . basename($l['file'] ?? '?') . ':' . ($l['line'] ?? '?') . '] ' . ($m ?: "Expected " . json_encode($e) . " got " . json_encode($a)) . PHP_EOL;
        return false;
    }
    public function assertTrue($v, $m = '') { return $this->assertEquals(true, $v, $m); }
    public function assertFalse($v, $m = '') { return $this->assertEquals(false, $v, $m); }
    public function assertNull($v, $m = '') { return $this->assertEquals(null, $v, $m); }
    public function assertNotNull($v, $m = '') { if ($v !== null) { $this->passed++; return true; } $this->failed++; echo "  FAIL {$m}" . PHP_EOL; return false; }
    public function assertNotEquals($e, $a, $m = '') { if ($e !== $a) { $this->passed++; return true; } $this->failed++; echo "  FAIL {$m}" . PHP_EOL; return false; }
    public function assertArrayHasKey($k, $arr, $m = '') { if (is_array($arr) && array_key_exists($k, $arr)) { $this->passed++; return true; } $this->failed++; echo "  FAIL {$m}" . PHP_EOL; return false; }
    public function assertCount($e, $arr, $m = '') { $c = is_array($arr) ? count($arr) : -1; if ($c === $e) { $this->passed++; return true; } $this->failed++; echo "  FAIL {$m} expected $e got $c" . PHP_EOL; return false; }
    public function summary() { return [$this->passed, $this->failed]; }
}