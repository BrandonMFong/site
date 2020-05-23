param([switch]$Default,[switch]$sandbox)
$creds = Get-Content $PSScriptRoot\..\config\ssh.json|Out-String|ConvertFrom-Json
[XML]$FTPItems = Get-Content $PSScriptRoot\..\config\Transfer.xml

if($Default)
{
  foreach($dest in $FTPItems.Site.Destination)
  {
    if($dest.Name -eq "Default")
    {
      [System.Object[]]$Processes = $dest.Processes;
      foreach($item in $Processes.Process)
      {
        Write-Host "`nTag: $($item.Tag)" -ForegroundColor Green;
        & "C:\Program Files (x86)\WinSCP\winscp.com" `
          /log="B:\SOURCES\Repos\site\logs\winscp.log" /ini=nul `
          /command `
          "open sftp://$($creds.Username)@$($creds.IP):$($creds.Port)/ -hostkey=`"`"$($creds.HostKey)`"`" -privatekey=`"`"$($creds.sshkeyPath)`"`" -passphrase=`"`"$($creds.Password)`"`"" `
          "lcd $($item.LCD)" `
          "cd $($item.CD)" `
          "put $($item.Package)" `
          "exit"
      }
    }
  }
}
if($sandbox)
{
  foreach($dest in $FTPItems.Site.Destination)
  {
    if($dest.Name -eq "sandbox")
    {
      [System.Object[]]$Processes = $dest.Processes;
      foreach($item in $Processes.Process)
      {
        Write-Host "`nTag: $($item.Tag)" -ForegroundColor Green;
        & "C:\Program Files (x86)\WinSCP\winscp.com" `
          /log="B:\SOURCES\Repos\site\logs\winscp.log" /ini=nul `
          /command `
          "open sftp://$($creds.Username)@$($creds.IP):$($creds.Port)/ -hostkey=`"`"$($creds.HostKey)`"`" -privatekey=`"`"$($creds.sshkeyPath)`"`" -passphrase=`"`"$($creds.Password)`"`"" `
          "lcd $($item.LCD)" `
          "cd $($item.CD)" `
          "put $($item.Package)" `
          "exit"
      }
    }
  }
}

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