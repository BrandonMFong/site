# Loads config
[System.object[]]$XmlReader = Get-Content $PSScriptRoot\..\config\LaunchSite.json|Out-String|ConvertFrom-Json

# Constructs path
[string]$DestinationPath = $XmlReader.Destination + "\$($XmlReader.SiteName)";

Push-Location $XmlReader.Source;
    [System.Object[]]$Directories = (Get-ChildItem).FullName; # Puts all items in source path
    for($i=0;$i -lt $Directories.Length;$i++)
    {
        [Boolean]$Exclude = $false; # Only able to exclude files from the base path perspective
        for($j=0;$j -lt $XmlReader.Exclude.Length;$j++)
        {
            if($XmlReader.Exclude[$j] -eq $($Directories[$i]|Split-Path -Leaf)){$Exclude=$true;}
        }
        if(!$Exclude){Copy-Item $Directories[$i] $DestinationPath -Force -Recurse -Verbose;}
    }
Pop-Location;
Set-Alias chrome "$($XmlReader.DefaultBrowserPath)";
chrome "$($XmlReader.URL)";