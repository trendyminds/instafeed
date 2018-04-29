<?php
namespace Craft;

class InstafeedVariable {
    public function posts()
    {
        return craft()->instafeed->getPosts();
    }
}
