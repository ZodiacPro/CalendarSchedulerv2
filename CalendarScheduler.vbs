Set WshShell = CreateObject("WScript.Shell")

strCurDir    = WshShell.CurrentDirectory

WshShell.Run chr(34) & strCurDir & "\run.cmd" & chr(34), 0
Set WshShell = Nothing