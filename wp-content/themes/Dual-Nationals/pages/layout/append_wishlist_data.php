

<section class="watch_list py_8">
    <div class="container">
        <div class="row">
            <div class="tittle_heading">
                <h2> Watchlist</h2>
            </div>
            <div class="watch_list_table">
                <table id="watch_list_data" class="table table-striped" style="width:100%">
                    <thead>
                        <input type="hidden" name="admin_url" id="admin_url"
                            value="<?php echo admin_url( 'admin-ajax.php' );?>">
                        <tr>
                            <th>Players</th>
                            <th>Clubs</th>
                            <th>Age</th>
                            <th>Nat.</th>
                            <th>Market Value</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // echo '<pre>'; print_r($fetch_all_football_player);die;
                        foreach ($fetch_all_football_player as $key => $value) {
                            

                        }

                        ?>


                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>