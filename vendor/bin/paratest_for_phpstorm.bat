@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/paratest_for_phpstorm
php "%BIN_TARGET%" %*
