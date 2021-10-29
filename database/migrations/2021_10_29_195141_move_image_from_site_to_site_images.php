<?php

use App\Models\Site;
use App\Models\SiteImage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoveImageFromSiteToSiteImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->integer('site_image_id')->nullable()->index();
        });

        $sites = Site::query()->get();
        /** @var Site $site */
        foreach ($sites as $site) {
            if (!$site->s3_path) {
                continue;
            }

            $siteImage = new SiteImage([
                'original_file_name' => 'don\'t have',
                's3_path' => $site->s3_path
            ]);
            $siteImage->user_id = 1;
            $siteImage->save();

            $site->site_image_id = $siteImage->id;
            $site->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->dropColumn('site_image_id');
        });
    }
}
