# Loads config
[System.object[]]$JSONReader = Get-Content $PSScriptRoot\..\config\LaunchSite.json|Out-String|ConvertFrom-Json

# Constructs path
[string]$DestinationPath = $JSONReader.Destination + "\$($JSONReader.SiteName)";

Remove-Item $DestinationPath -Force -Recurse -Verbose;
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
        if(!$Exclude){Copy-Item $Directories[$i] $DestinationPath -Force -Recurse -Verbose;}
    }
Pop-Location;
Set-Alias chrome "$($JSONReader.DefaultBrowserPath)";
chrome "$($JSONReader.URL)/$($JSONReader.SiteName)";