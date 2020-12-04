# Loads config
[System.object[]]$JSONReader = Get-Content $PSScriptRoot\..\config\LaunchSite.json|Out-String|ConvertFrom-Json

# Constructs path and obtain necessary executables
[string]$DestinationPath = $JSONReader.Destination + "\htdocs" + "\$($JSONReader.SiteName)";
[string]$StartXampp = "$PSScriptRoot\start-xampp.ps1";
[string]$StopXampp = "$PSScriptRoot\stop-xampp.ps1";

Write-Host "`nRestarting Xampp" -ForegroundColor Green
& $StopXampp; # Stop Xampp instances that were previously on
& $StartXampp; # Start new Xampp instance
Write-Host "`n";
# Delete the content
if(![string]::IsNullOrEmpty($DestinationPath)){Remove-Item $DestinationPath -Force -Recurse -Verbose;}

mkdir $DestinationPath -Verbose;

Push-Location $JSONReader.Source;
    [System.Object[]]$Directories = (Get-ChildItem).FullName; # Puts all items in source path
    for($i=0;$i -lt $Directories.Length;$i++)
    {
        [Boolean]$Exclude = $false; # Only able to exclude files from the base path perspective
        for($j=0;$j -lt $JSONReader.Exclude.Length;$j++)
        {
            if($JSONReader.Exclude[$j] -eq $($Directories[$i]|Split-Path -Leaf)){$Exclude=$true;}
        }
        if(!$Exclude)
        {
            Copy-Item $Directories[$i] $DestinationPath -Force -Recurse;
            [int16]$percent = ($i/$Directories.Length) * 100;
            Write-Progress -Activity "Loading site" -Status "$($percent)% Complete:" -PercentComplete $percent;
        }
    }
Pop-Location;
Set-Alias chrome "$($JSONReader.DefaultBrowserPath)";
chrome "$($JSONReader.URL)/$($JSONReader.SiteName)"; # Open site
chrome "$($JSONReader.URL)/phpmyadmin/"; # Open phpmyadmin