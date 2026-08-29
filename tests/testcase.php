<?php
// Simple test case helper
class TC {
    private $passed = 0;
    private $failed = 0;

    public function eq($expected, $actual, $msg = '') {
        if ($expected === $actual) {
            $this->passed++;
        } else {
            $this->failed++;
            echo "  FAIL: $msg expected " . var_export($expected, true) . " got " . var_export($actual, true) . "\n";
        }
    }

    public function t($cond, $msg = '') {
        if ($cond) {
            $this->passed++;
        } else {
            $this->failed++;
            echo "  FAIL: $msg expected true\n";
        }
    }

    public function f($cond, $msg = '') {
        if (!$cond) {
            $this->passed++;
        } else {
            $this->failed++;
            echo "  FAIL: $msg expected false\n";
        }
    }

    public function s() {
        return [$this->passed, $this->failed];
    }
}
