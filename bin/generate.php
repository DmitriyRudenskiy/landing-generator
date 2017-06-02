<?php

$list = [
    'cuba-club.ru',
    'a.cuba-club.ru',
    'b.cuba-club.ru',
    'c.cuba-club.ru',
    'd.cuba-club.ru',
    'e.cuba-club.ru',
    'f.cuba-club.ru',
    'g.cuba-club.ru',
    'h.cuba-club.ru',
    'i.cuba-club.ru',
    'j.cuba-club.ru',
    'k.cuba-club.ru',
    'l.cuba-club.ru',
    'm.cuba-club.ru',
    'n.cuba-club.ru',
    'o.cuba-club.ru',
];

foreach ($list as $value) {
    $name = str_replace(['.', '-'], ['_', '_'], $value);
    $alias = str_replace(['.', '-'], ['', ''], $value);

    echo sprintf("acl %s hdr(host) -i %s\n", $alias, $name);
}


foreach ($list as $value) {
    $alias = str_replace(['.', '-'], ['', ''], $value);

    echo sprintf("    use_backend %s_backend if %s\n", $alias, $alias);
}


foreach ($list as $value) {
    $alias = str_replace(['.', '-'], ['', ''], $value);

    echo sprintf("    backend %s_backend\n        server node1 127.0.0.1:100\n\n", $alias);
}


