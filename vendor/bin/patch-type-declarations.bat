@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/patch-type-declarations
php "%BIN_TARGET%" %*
