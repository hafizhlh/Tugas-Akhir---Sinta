<?php

namespace Deployer;

desc('Deploy secrets');
task('deploy:secrets', function() {
    // deploy_path sudah di definisikan di dalam file deploy.php
    run('cp $HOME/env/pihc_temp/.env {{deploy_path}}/shared');
});

desc('Execute artisan migrate:fresh with seeder');
task('artisan:migrate:freshseed', artisan('migrate:fresh --seed'));