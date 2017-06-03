<?php
/**
 * Created by PhpStorm.
 * User: fitzz
 * Date: 17-6-1
 * Time: 下午8:58
 */
$app->get('/1', function () use ($app) {
    return $app->version();
});
    $app->get('/test',function () {
        return 'Hello';
});