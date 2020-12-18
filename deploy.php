<?php

namespace Deployer;

require 'vendor/shopping/deployer-recipes/recipe/c24symfony4.php';

set('app_name', 's2-challenge-checkout');
set('unix_user', get('app_name'));

set('feature_migration', false);
set('feature_supervisor', false);
set('feature_fluent_bit', false);

loadInventory(get('unix_user'));

localhost()
    ->set('unix_user', 'vagrant')
    ->roles('nginx', 'php-fpm', 'migration', 'supervisor')
    ->stage(getDefaultStage());
