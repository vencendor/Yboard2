<?php


Yii::import('application.vendors.*');
require_once('youtube.php');


class YoutubeHelper {

    /**
     * Save video to youtube.
     * @param Bulletin $model
     * @param CUploadedFile $video
     */
    public static function processBulletin($model, $video) {
        if (!empty($video)) {
            if (is_array($video))
                $video = current($video);
            $youtube_id = Upload($video, $model->name, $model->text, 'Animals', 'Tags');
            if (!empty($youtube_id)) {
                $model->youtube_id = $youtube_id;
                $model->save();
            }
        }
    }

    /**
     * Save videos to youtube.
     * @param Advertisement $model
     * @param CUploadedFile[] $videos
     */
    public static function processAdvertisement($model, $videos) {
        if (!empty($videos) && is_array($videos)) {
            $result = array();
            foreach ($videos as $video) {
                $result[] = Upload($video, $model->name, $model->description, 'Animals', 'Tags');
            }
            if (!empty($result)) {
                $model->youtube = $result;
                $model->save();
            }
        }
    }

}

?>
