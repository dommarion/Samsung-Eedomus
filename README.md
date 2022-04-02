# Eedomus-SamsungTV-php
/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/
The project consist in adapting the package vendor to the Eedomus box:
In a dedicated PHP servor:
Objective #1 is reducing the number of files, and instructions that are present into the vendor package.
Objective #2 is identifying the PHP instructions that couldn't be used into Eedomus because of restriction.
Objective #3 is trying to extend this scope into Eedomus, if not possible then program some dedicated functions to fill the gap.
In the Eedomus box:
Objective #4 is developping the Eedomus Plugin to control SAMSUNG TV.
/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/
Objective #1: reducing the number of files, and instructions that are present into the vendor package.
1. List the files that are needed for SAMSUNG TV out of the 141 files by using var_dump(get_included_files()); at the end of control.php or gettokken.php
   This first trail has reduced from 141 to 87 files. This has been successful tested and the Samsung TV is controlled.
2. Check into the remaining files if some instructions aren't used and thus some files could be removed
   2.1. First review on Connector.php shown that "$options += array('tcp' => true,'tls' => true,'unix' => true,'dns' => true,'timeout' => true,); could be changed to
        $options += array('tcp' => false,'tls' => true,'unix' => false,'dns' => false,'timeout' => true,);
        reducing the number of files from 87 to xx
   2.2. Review other files to check is some items are obviously not usefull for our project.
   2.3. Implement a tracking function to trace what is really used inside of each xx files and analyse it to shrink the number of instructions and files.
3. .../...
Objective #2: identifying the PHP instructions that couldn't be used into Eedomus because of restriction.
1. Scan the remaining files with the list of Eedomus authorized instructions (if this could be automatized, it would be great)
