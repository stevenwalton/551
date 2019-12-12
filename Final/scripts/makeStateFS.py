#!/usr/bin/python3

import argparse
import os
import time
from makeCountryFS import makeCountry


def arglist():
    parser = argparse.ArgumentParser(prog="Generate Sites")
    parser.add_argument('-c', '--country', default='default', type=str,
                        help="country we wish our state to be in")
    parser.add_argument('-s', '--state', default='default', type=str,
                        help="state we wish to make a php file for")
    return parser.parse_args()

def makeState(state,country):
    
    pathname = 'Countries/'
    print(f"Checking for {pathname}")
    i = 0
    while(not os.path.exists(pathname)):
        pathname = "../" + pathname
        print(f"Checking for {pathname}")
        i += 1
        if (i > 10):
            exit(1)
    if(not os.path.exists(pathname + "/" + country)):
        makeCountry(country)
        #print(f"Couldn't find country: {country}")
        #exit(1)
    skel = f'''
<?php
include_once '../../../src/connect.php';
include_once '../../../src/basicFunctions.php';
include_once '../../../src/siteFunctions.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Climbing Project</title>
    </head>
    <body>
    <a href="/~swalton2/551/Final">
    <img src="/~swalton2/551/Final/media/Title.png">
    </a>
    <br>
    Country: <a href=../>{country}</a> State: {state}
    <br>
    Available Sites
    <br>
    <?php
    $object = new Site;
    $sites = $object->getSitesInStateNamed({state},{country});
    if ($sites == NULL)
    {{
        echo("Sorry, there are no states listed for this country");
    }}
    ?>
    <?php foreach ($sites as $site): ?>
        <a href="./<?php echo($site); ?>"> <?php echo($site); ?></a>
    <?php endforeach; ?>
    <?php include '../../../footer.php';?>    
</html>
    '''
        
    pathname += country + "/" + state
    os.mkdir(pathname)
    print(f"Making file at {pathname}")
    with open(pathname + "/index.php",'w') as f:
        f.write(skel)

if __name__ == '__main__':
    args = arglist()
    makeState(args.state, args.country)
