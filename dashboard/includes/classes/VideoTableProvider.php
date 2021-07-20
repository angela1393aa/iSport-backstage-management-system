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

    public function createRowCountSelect() {

        return "<select id='rowCountSelect' aria-label='Default select example' class='form-select form-control-sm mr-2' onchange='selectRowCount(this.value)' style='width: 120px; background-color:#2A3F54;border:none;border-radius:5px; color: white;'>
                    <option value='3'>顯示 3 筆</option>
                    <option value='5' selected>顯示 5 筆</option>
                    <option value='8'>顯示 8 筆</option>
                    <option value='10'>顯示 10 筆</option>
                    <option value='12'>顯示 12 筆</option>
                </select>";
    }

    public function createSearchInput() {

        return "<div class='col-md-5 col-sm-5 form-group pull-right top_search'>
				<div class='input-group'>
					<input type='text' id='searchInput' class='form-control' placeholder='輸入關鍵字...' autocomplete='off' name='q'>
				</div>
			</div>";
    }

    public function createUploadSuccessMessage() {

        return "<div class='modal fade' id='uploadSuccessMessage' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true' data-backdrop='static' data-keyboard='false'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content warningModal'>
                            <div class='modal-header warning'>
                                <h3 class='modal-title text-dark h3-warning' id='exampleModalLongTitle'>上傳成功</h3>
                                <button type='button' class='close sp-warning' data-dismiss='modal' aria-label='Close'>
                                    <span class='' aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body warning'>
                                <img src='images/success.png' alt='Success!'>
                                <h5 class='text-dark h5-warning'>影片上傳完成！</h5>
                            </div>
                            <div class='modal-footer warning'>
                                <button type='button' class='btn btn-primary' data-dismiss='modal'>確定</button>
                            </div>
                        </div>
                    </div>
                </div>";
    }
}
?>
