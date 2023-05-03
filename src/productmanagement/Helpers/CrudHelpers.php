<?php
namespace bushart\productmanagement;
class CrudHelpers
{
    /**
     * This is used to format errors
     *
     * @param $data
     *     array:2 [
     * "email" => array:1 [
     * 0 => "The email has already been taken."
     * ]
     * "mobile_number" => array:1 [
     * 0 => "The mobile number has already been taken."
     * ]
     * ]
     * @return array
     *
     * array:2 [
     * 0 => "The email has already been taken."
     * 1 => "The mobile number has already been taken."
     * ]
     */
    static function formatErrors($data)
    {
        $errors = [];
        if (!empty($data)) {
            foreach ($data as $row) {
                if ($row) {
                    foreach ($row as $value) {
                        $errors[] = $value;
                    }
                }
            }
        }

        return $errors;
    }

    /**
     * make_complete_pagination_block
     * @param $obj
     * @param string $type | three possible values 1)short (for short paragraph) 2)long (for long paragraph) 3) null (for no paragraph) .
     * @return  complete pagination block
     */
    static function make_complete_pagination_block($obj, $type = null)
    {
        $info = "";
        $end = $obj->currentPage() * $obj->perPage();
        $start = $end - ($obj->perPage() - 1);
        $current_page = $obj->currentPage();
        $last_page = $obj->lastPage();
        if ($start < 1) {
            $start = 1;
        }
        $total = $obj->total();
        if ($end > $total) {
            $end = $total;
        }
        if ($type) {
            if ($total > 0) {
                if ($type == 'long') {
                    $info = "<div class='pager-info'><p>Showing $start to $end of $total Records.</p><div class='clr'></div></div>";
                } else {
                    $info = "<div class='pager-info'><p>Displaying $current_page of $last_page Pages</p><div class='clr'></div></div>";
                }
            }
        }

        return view('productmanagement::_pager', compact('info', 'obj'))->render();
    }

    /**
     * get_pager_info_paragraph | it will a paginator object provided by laravel paginate method and will return a paragraph line item with the info about total records and showing records range according to the current page.
     * @param array $obj | paginator object provided by laravel paginate method
     * @param string $type | three possible values 1)short (for short paragraph) 2)long (for long paragraph) 3) null (for no paragraph) .
     * @return returns string | returns a string (paragraph line with star end and total records according to the current page.)
     *
     */
    static function get_pager_info_paragraph($obj, $type = 'long')
    {
        $info = "";
        $end = $obj->currentPage() * $obj->perPage();
        $start = $end - ($obj->perPage() - 1);
        $current_page = $obj->currentPage();
        $last_page = $obj->lastPage();
        if ($start < 1) {
            $start = 1;
        }
        $total = $obj->total();
        if ($end > $total) {
            $end = $total;
        }
        if ($type) {
            if ($total > 0) {
                if ($type == 'long') {
                    $info = "<div class='pager-info'><p>Showing $start to $end of $total Records.</p><div class='clr'></div></div>";
                } else {
                    $info = "<div class='pager-info'><p>Displaying $current_page of $last_page Pages</p><div class='clr'></div></div>";
                }
            }
        }

        return $info;
    }

    /**
     * This is used to generate headers dynamically
     *
     * @param $array
     * @return array
     *      array:14 [▼
     * 0 => array:3 [▼
     * "name" => "Sr. NO"
     * "key" => "srn"
     * "isSorter" => true
     * ]
     * 1 => array:3 [▶]
     * 2 => array:3 [▶]
     */
    static function generateHeaders($array)
    {
        $headers = [];
        foreach ($array as $key => $row) {
            $headers[$key]['name'] = $row[0];
            if (isset($row[1])) {
                $keyName = $row[1];
            } else {
                $keyName = str_replace(' ', '_', strtolower($row[0]));
            }
            $headers[$key]['key'] = $keyName;
            $headers[$key]['isSorter'] = (isset($row[2])) ? $row[2] : true;
        }

        return $headers;
    }

    /**
     * This is used to get indexes
     *
     * @param $array
     * @param $values
     * @return $array
     *
     *     array:2 [▼
     * "               order_number" => 1
     * "               custom_label" => 24
     * ]
     *
     */
    static function getIndexByValue($array, $values)
    {
        $indexes = [];
        foreach ($values as $index) {
            foreach ($array as $key => $row) {
                $rowValue = str_replace([' ', '/', ' – '], '_', strtolower($row));
                if ($index == $rowValue) {
                    $indexes[$rowValue] = $key;
                    break;
                }
            }
        }

        return $indexes;
    }

    /**
     * This is used to find header by index
     *
     * @param $array
     * @param $index
     * @return bool
     */
    static function findHeaderByIndex($array, $index)
    {
        $isHeaderExist = false;
        foreach ($array as $row) {
            $rowValue = str_replace(' ', '_', strtolower($row));
            if ($index == $rowValue) {
                $isHeaderExist = true;
            }
        }

        return $isHeaderExist;
    }

    /**
     * This is used to convert date to data base time format
     *
     * @param $date
     * @return false|string
     */
    static function databaseDateFromat($date)
    {
        return date_format(new \DateTime($date), 'Y-m-d');
    }

    /**
     * This is used to generate grid headers
     *
     * @param $data
     * @return array
     *              array:9 [
     * 0 => array:2 [
     * "name" => "transaction_creation_date"
     * "isDisplay" => true
     * ]
     * 1 => array:2 [
     * "name" => "type"
     * "isDisplay" => true
     * ]
     * 2 => array:2 [
     * "name" => "order_number"
     * "isDisplay" => true
     * ]
     */
    static function generateGridHeaders($data)
    {
        $arr = [];
        foreach ($data as $key => $row) {
            $arr[$key]['name'] = $row[0];
            $arr[$key]['isDisplay'] = (isset($row[1])) ? $row[1] : true;
        }
        return $arr;
    }

    /**
     * This is used to generate popup headers
     *
     * @param $data
     * @return array
     */
    static function generateShowHeaders($data)
    {
        $arr = [];
        foreach ($data as $key => $row) {
            $arr[$key]['name'] = $row[0];
            if (isset($row[1])) {
                $keyName = $row[1];
            } else {
                $keyName = str_replace(' ', '_', strtolower($row[0]));
            }
            $arr[$key]['key'] = $keyName;
        }

        return $arr;
    }

    /**
     * Upload image
     *
     * @param $request
     * @param $input
     * @param $path
     * @param $previousImage
     * @return string
     */
    static function uploadImage($request, $input, $path, $previousImage = '')
    {
        $fileName = '';
        if ($request->hasFile($input)) {
            if (isset($previousImage) && !empty($previousImage)) {
                $previousImagePath = public_path($path) . $previousImage;
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }
            $fileName = $request->$input->hashName();
            $image = $request->file($input);
            $destinationPath = public_path($path);
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $image->move($destinationPath, $fileName);
        }


        return $fileName;
    }

    /**
     * Used to remove/unlink stored image when delete
     *
     * @param $arr
     * @param $path
     * @param $columnName
     * @return bool
     */
    static function removeImagesFromStorage($arr, $path, $columnName = 'image')
    {
        $isDelete = false;
        if (!empty($arr)) {
            foreach ($arr as $key => $row) {
                if (!empty($row[$columnName])) {
                    $previousImagePath = public_path($path) . $row[$columnName];
                    if (file_exists($previousImagePath)) {
                        unlink($previousImagePath);
                        $isDelete = true;
                    }
                }
            }
        }

        return $isDelete;
    }

    /**
     * Upload multiple files
     *
     * @param $input
     * @param $path
     * @param string $previousImage
     * @return array
     */
    static function uploadMultipleImages($input, $path, $previousImage = '')
    {
        $originalName = '';
        $arrImages = [];
        $fileName = '';
        if ($input) {
            if (isset($previousImage) && !empty($previousImage)) {
                $previousImagePath = public_path($path) . $previousImage;
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }
            $fileName = $input->hashName();
            $originalName = $input->getClientOriginalName();
            $image = $input;
            $destinationPath = public_path($path);
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $image->move($destinationPath, $fileName);
        }
        $arrImages['original_name'] = $originalName;
        $arrImages['file_name'] = $fileName;

        return $arrImages;
    }

    /**
     * Create productAttachment Array
     *
     * @param $attachments
     * @param $id
     * @param $name
     * @return array
     */
    static function getArrayAttachment($attachments, $id, $name)
    {
        $arr = [];
        $imageDetail = '';
        foreach ($attachments as $key => $row) {
            if ($name == 'image') {
                $imageDetail = CrudHelpers::uploadMultipleImages($row, 'images/multiple-product-image');
            }
            $arr[$key]['listing_id'] = $id;
            $arr[$key]['color_id'] = $name == 'color_id' ? $row : null;
            $arr[$key]['material_id'] = $name == 'material_id' ? $row : null;
            $arr[$key]['image'] = $name == 'image' ? $imageDetail['file_name'] : null;
            $arr[$key]['image_original_name'] = $name == 'image' ? $imageDetail['original_name'] : null;
            $arr[$key]['created_at'] = now();
            $arr[$key]['updated_at'] = now();
        }

        return $arr;
    }
}
