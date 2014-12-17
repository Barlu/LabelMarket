<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utils
 *
 * @author emmett.newman
 */
class Utils {

    public static function createLink($page, array $params = array()) {
        $params = array_merge(array('page' => $page), $params);
        return 'index.php?' . http_build_query($params);
    }

    public static function redirect($page, array $params = array()) {
        header('Location:' . self::createLink($page, $params));
        die();
    }

    public static function escape($string) {
        return htmlspecialchars($string, ENT_QUOTES);
    }
    
     public static function strip($string) {
        return stripslashes($string);
    }

    public static function getUrlParam($name) {
        if (!array_key_exists($name, $_GET)) {
            throw new NotFoundException('URL parameter "' . $name . '" not found');
        } else {
            return $_GET[$name];
        }
    }
    
    public static function convertDateToTimestamp($str){
        $dateTime = DateTime::createFromFormat('d/m/Y', $str);
        $timestamp = $dateTime->getTimestamp();
        return $timestamp;
    }
    
    public static function convertTimestampDateOnly($timestamp){
        $date = new DateTime();
        $date->setTimestamp($timestamp);
        $result = Dao::formatDate($date);
        return $result;
    }
    public static function convertTimestamp($timestamp){
        $date = new DateTime();
        $date->setTimestamp($timestamp);
        $result = Dao::formatDateTime($date);
        return $result;
    }

    public static function createSoundcloudLinkMaster($id) {
        $link = '<iframe width="100%" height="65" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/' . $id . '&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=false&amp;show_user=false&amp;show_reposts=false"></iframe>';
        return $link;
    }

    public static function createSoundcloudLinkDetail($id) {
        $link = '<iframe width="100%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/' . $id . '&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>';
        return $link;
    }

    public static function createMixcloudLinkMaster($id) {
        if (strlen(trim($id)) !== 0) {
            $id = explode('/', $id);
            $link = '<iframe width="100%" height="60" src="https://www.mixcloud.com/widget/iframe/?feed=http%3A%2F%2Fwww.mixcloud.com%2F' . $id[1] . '&amp;mini=1&amp;embed_uuid=' . $id[0] . '&amp;replace=0&amp;hide_cover=1&amp;embed_type=widget_standard&amp;hide_tracklist=1" frameborder="0"></iframe>';
        } else {
            $link = '';
        }
        return $link;
    }

    public static function createMixcloudLinkDetail($id) {
        if (strlen(trim($id)) !== 0) {
            $id = explode('/', $id);
            $link = '<iframe width="100%" height="360" src="https://www.mixcloud.com/widget/iframe/?feed=http%3A%2F%2Fwww.mixcloud.com%2F' . $id[1] . '&amp;embed_uuid=' . $id[0] . '&amp;replace=0&amp;light=1&amp;embed_type=widget_standard&amp;autoplay=0" frameborder="0"></iframe>';
        } else {
            $link = '';
        }
        return $link;
    }

    public static function stripMixcloudId($link) {
        $linkId = '';
        if (strlen(trim($link)) !== 0) {
            preg_match("/uuid=(.*?)&amp;/s", $link, $matches);
            if (array_key_exists(1, $matches)) {
                $linkId = $matches[1];
            }
            preg_match("/mixcloud.com%2F(.*?)&amp;/s", $link, $matches);
            if (array_key_exists(1, $matches)) {
                $linkId .= '/' . $matches[1];
            }
        }
        if(strlen(trim($linkId)) !== 0){
            return $linkId;
        }
        return false;
    }
    
    public static function stripSoundcloudId($link) {
        $linkId = '';
        if (strlen(trim($link)) !== 0) {
            preg_match("/tracks\/(.*?)&amp;/s", $link, $matches);
            if (array_key_exists(1, $matches)) {
                $linkId = $matches[1];
            }
        }
        if(strlen(trim($linkId)) !== 0){
            return $linkId;
        }
        return false;
    }

    public static function cryptPassword($password) {
        $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

        $hash = crypt($password, $salt);

        return $hash;
    }

    public static function checkPassword($password, $hash) {
        if (strcmp(crypt($password, $hash), $hash) === 0) {
            return true;
        }
        return false;
    }

}
