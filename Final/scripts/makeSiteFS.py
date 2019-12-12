#!/usr/bin/python3

import argparse
import os
import time
from makeStateFS import makeState


def arglist():
    parser = argparse.ArgumentParser(prog="Generate Sites")
    parser.add_argument('-c', '--country', default='default', type=str,
                        help="country we wish our state to be in")
    parser.add_argument('-s', '--state', default='default', type=str,
                        help="Name of the state")
    parser.add_argument('-i', '--site', default='default', type=str,
                        help="Name of the site")
    return parser.parse_args()

def makeSite(site,state,country):
    pathname = 'Countries/'
    print(f"Checking for {pathname}")
    i = 0
    while(not os.path.exists(pathname)):
        pathname = "../" + pathname
        print(f"Checking for {pathname}")
        i += 1
        if (i > 10):
            exit(1)
    if(not os.path.exists(pathname + "/" + country + "/" + state)):
        makeState(state,country)
    skel = f'''
<?php
include_once '../../../../src/connect.php';
include_once '../../../../src/basicFunctions.php';
include_once '../../../../src/siteFunctions.php';
include_once '../../../../src/areaFunctions.php';
include_once '../../../../src/routeFunctions.php';
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
    Country: <a href=../../>{country}</a> State: <a href=../>{state}</a>
    <br>
    Available Areas
    <br>
    <?php
    $_site = new Site;
    $sites = $_site->getSitesInStateNamed("{state}","{country}");
    if ($sites == NULL)
    {{
        echo("Sorry, there are no sites listed for this state");
    }}
    ?>
    <?php foreach ($sites as $site): ?>
        <a href="./{site}/<?php echo($site); ?>"> <?php echo($site); ?></a>
    <?php endforeach; ?>
    <?php include '../../../../footer.php';?>    
</html>
    '''
        
    pathname += country + "/" + state + "/" + site
    print(f"I make sites at {pathname}")
    os.mkdir(pathname)
    with open(pathname + "/index.php",'w') as f:
        f.write(skel)

if __name__ == '__main__':
    args = arglist()
    makeSite(args.site,args.state, args.country)
