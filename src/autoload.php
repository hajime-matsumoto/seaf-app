<?php
/**
 * Seaf Auto Load
 */
Seaf::di('autoLoader')->addNamespace(
    'Seaf\\App',
    null,
    dirname(__FILE__).'/App'
);
