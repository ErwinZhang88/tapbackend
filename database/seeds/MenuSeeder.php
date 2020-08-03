<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $url = url('/');
        DB::statement("UPDATE banners SET banner = replace(banner, 'https://tapadmin.wooz.in','".$url."');");
        DB::statement("UPDATE banners SET banner_mobile = replace(banner_mobile, 'https://tapadmin.wooz.in','".$url."');");
        DB::statement("UPDATE file_lists SET name = replace(name, 'https://tapadmin.wooz.in','".$url."');");
        DB::statement("UPDATE complains SET bukti = replace(bukti, 'https://tapadmin.wooz.in','".$url."');");
        DB::statement("UPDATE content_posts SET images = replace(images, 'https://tapadmin.wooz.in','".$url."');");
        DB::statement("UPDATE content_posts SET icon = replace(icon, 'https://tapadmin.wooz.in','".$url."');");
        DB::statement("UPDATE content_posts SET files = replace(files, 'https://tapadmin.wooz.in','".$url."');");
        DB::statement("UPDATE content_post_translations SET description = replace(description, 'https://tapadmin.wooz.in','".$url."');");
        DB::statement("UPDATE menus SET banner = replace(banner, 'https://tapadmin.wooz.in','".$url."');");
        DB::statement("UPDATE menus SET banner_mobile = replace(banner_mobile, 'https://tapadmin.wooz.in','".$url."');");
        DB::statement("UPDATE menus SET icon = replace(icon, 'https://tapadmin.wooz.in','".$url."');");
    }
}
