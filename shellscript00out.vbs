Set WinScriptHost = CreateObject("WScript.Shell")
WinScriptHost.Run Chr(34) & "C:\xampp\htdocs\cron\cronsap00out.bat" & Chr(34), 0
Set WinScriptHost = Nothing