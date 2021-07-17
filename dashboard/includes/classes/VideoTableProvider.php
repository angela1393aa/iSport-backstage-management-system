<?php
class VideoTableProvider {

    public function createTable() {
        
        return "<div class='table-responsive'>
                    <table class='table table-Primary table-hover jambo_table bulk_action video-table'>
                        <thead class='thead'>
                            <tr class='headings'>
                                <th class='px-3 py-3 th-pic'>影片縮圖</th>
                                <th class='px-2 py-3 th-title'>影片名稱</th>
                                <th class='px-3 py-3 th-description'>說明</th>
                                <th class='px-2 py-3 th-category'>分類</th>
                                <th class='px-2 py-3 th-duration th-sortable' onclick='sortable(this)' data-value='9' data-column='duration' data-order='desc' style='cursor: pointer'>影片長度 &#9650;</th>
                                <th class='px-2 py-3 th-uploadTime th-sortable' onclick='sortable(this)' data-value='11' data-column='upload_date' data-order='desc' style='cursor: pointer'>上傳時間 &#9650;</th>
                                <th class='px-2 py-3 th-view th-sortable' onclick='sortable(this)' data-value='13' data-column='views' data-order='desc' style='cursor: pointer'>瀏覽次數 &#9650;</th>
                            </tr>
                        </thead>
                        <tbody id='videoTableItems'>
                            
                        </tbody>
                    </table>
                </div>";
    }

    public function createSelect() {

        return "<select id='categorySelect' aria-label='Default select example' class='form-select form-control-sm' onchange='selectOption()' style='width: 120px; background-color:#2A3F54;border:none;border-radius:5px; color: white;'>
                    
                </select>";
    }

    public function createSearchInput() {

        return "<div class='col-md-5 col-sm-5 form-group pull-right top_search'>
				<div class='input-group'>
					<input type='text' id='searchInput' class='form-control' placeholder='輸入關鍵字...' autocomplete='off' name='q'>
				</div>
			</div>";
    }
}
?>