
$creds = Get-Content $PSScriptRoot\..\config\ssh.json|Out-String|ConvertFrom-Json
& "C:\Program Files (x86)\WinSCP\winscp.com" `
  /log="B:\SOURCES\Repos\site\logs\winscp.log" /ini=nul `
  /command `
    "open sftp://$($creds.Username)@$($creds.IP):$($creds.Port)/ -hostkey=`"`"$($creds.HostKey)`"`" -privatekey=`"`"$($creds.sshkeyPath)`"`" -passphrase=`"`"$($creds.Password)`"`"" `
    "lcd B:\SOURCES\Repos\Site" `
    "cd /home/u820870703/domains/brandonmfong.com/public_html" `
    "put img" `
    "lcd B:\SOURCES\Repos\Site" `
    "cd /home/u820870703/domains/brandonmfong.com/public_html" `
    "put docs" `
    "lcd B:\SOURCES\Repos\Site\config" `
    "cd /home/u820870703/domains/brandonmfong.com/public_html/config" `
    "put environmentcredentials.xml" `
    "exit"

$winscpResult = $LastExitCode
if ($winscpResult -eq 0)
{
  Write-Host "Success"
}
else
{
  Write-Host "Error"
}

exit $winscpResult