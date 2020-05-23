# An alias exists already in my environment
$creds = Get-Content $PSScriptRoot\..\config\ssh.json|Out-String|ConvertFrom-Json
putty -ssh "$($creds.Username)@$($creds.IP)" $creds.Port -i $creds.sshkeyPath -pw $creds.Password