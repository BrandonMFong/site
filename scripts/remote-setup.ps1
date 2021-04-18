New-Item $PSScriptroot\..\logs\winscp.log -Force -Verbose|Out-Null;
[string]$logname = (Get-ChildItem $PSScriptroot\..\logs\winscp.log).FullName;

if(!(Test-Path $PSScriptroot\..\logs\deploy.log)){New-Item $PSScriptroot\..\logs\deploy.log;}

[string]$Date = Get-Date -Format "dddd MM/dd hh:mm:ss tt";
Add-Content $PSScriptroot\..\logs\deploy.log -Value "[$($Date)] Computer=$($env:USERDOMAIN), Tag=$(git describe --tags)";

& "C:\Program Files (x86)\WinSCP\WinSCP.com" `
  /log="$($logname)" /ini=nul `
  /command `
    "open sftp://brandonmfong@10.0.0.60/ -hostkey=`"`"ssh-ed25519 255 IU7Ke959JWplUHx+ZeHOBOQOjzHhHboZg2kHdLvyGFs=`"`" -privatekey=`"`"B:\.ssh\Kojami.rpi_key.ppk`"`" -rawsettings Cipher=`"`"aes,chacha20,3des,WARN,des,blowfish,arcfour`"`"" `
    "lcd B:\SOURCE\Repo\Site" `
    "cd /var/www/brandonmfong.com" `
    "rm *" `
    "put config" `
    "put css" `
    "put docs" `
    "put fontawesome-5.5" `
    "put function" `
    "put img" `
    "put info" `
    "put js" `
    "put magnific-popup" `
    "put schema" `
    "put scripts" `
    "put slick" `
    "put sql" `
    "put views" `
    "put index.php" `
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
