<?php


class WishListModel extends CI_Model{

    /**
     * method to get items from the db, relevant to user id
     */

    public function fetchItems($uid){
        $this->db->select("*");
        $this->db->where("username",$uid);
        $this->db->from("wishlist_items");
        $resultsQuery = $this->db->get();
        return $resultsQuery->result();
    }

    /**
     * inserting wishlist items to the database
     */
    public function addWishlistItems($itemsData){
        $this->db->insert('wishlist_items', $itemsData);
        $insertedID = $this->db->insert_id();

        $responseID = array(
            'id' => $insertedID
        );
        log_message('debug', "addItem_ID " . print_r($responseID, True));
        return $responseID;

    }
    /**
     * updating wishlist item details in the database
     */

    public function updateWishlistItems($updateWishlistData,$itemId){
        $this->db->where('id', $itemId);
        $this->db->update('wishlist_items', $updateWishlistData);
        return $this->db->affected_rows() > 0;
    }

    /**
     * delete an item from the items table
     */

    public function deleteWishlistItem($deleteItemID){

        $this->db->delete('wishlist_items', array('id' => $deleteItemID));
        return $this->db->affected_rows() > 0;

    }


}

?>
