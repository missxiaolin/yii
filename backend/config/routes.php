<?php
return [
    'GET,HEAD role/index/<page>/<per-page>' => 'role/index', // 角色列表
    'GET,HEAD role/create-role/<id>' => 'role/create-role', // 添加角色
    'GET,HEAD role/assign-item/<name>' => 'role/assign-item' // 角色分配权限
];