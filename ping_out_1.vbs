Set WinScriptHost = CreateObject("WScript.Shell")
WinScriptHost.Run Chr(34) & "C:\xampp\htdocs\cron\gate_out_1.bat" & Chr(34), 0
Set WinScriptHost = Nothing