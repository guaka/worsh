# worsh - the WordPress Shell


WordPress Shell, inspired by [drush](http://drush.ws/), the super powerful Drupal shell.

Enough of phpmyadmin? Or twiddling with WordPress backend interface?
Do you want the power of shell to manage your WordPress websites?

**worsh** is not there, yet. But inspired by Drupal's drush we should
get something useful pretty fast.


## installation

You could create a convenient symlink:

    cd /usr/local/bin
    ln -s ~/worsh/worsh.php worsh



## Commands

**worsh** is brand new. By far not as powerful as drush, but here are
some commands that are supposed to work that can come in handy at times.


    worsh oget siteurl


    worsh sql-dump
    

    worsh plugin-list


    worsh theme-list