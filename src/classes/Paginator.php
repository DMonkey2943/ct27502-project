<?php

namespace CT27502\Project;

class Paginator {
    public int $totalPages; //Tổng số trang
    public int $recordOffset; //Vị trí bắt đầu của sản phẩm ở các trang hiện tại

    public function __construct(
        public int $recordsPerPage, //Số sản phẩm trên mỗi trang
        public int $totalRecords, //Tổng số sản phẩm
        public int $currentPage = 1, //Trang hiện tại (default là 1)
    ) {
        $this->totalPages = ceil($totalRecords / $recordsPerPage); //làm tròn lên (tổng số sp / số sp trên mỗi trang)
        if($currentPage < 1) {
            $this->currentPage = 1;
        }
        $this->recordOffset = ($this->currentPage - 1) * $this->recordsPerPage; // (trang hiện tại - 1)*số sp trên mỗi trang
    }

    public function getPrevPage(): int | bool {
        return $this->currentPage>1 ? $this->currentPage - 1 : false;
    }

    public function getNextPage(): int | bool {
        return $this->currentPage<$this->totalPages ? $this->currentPage + 1 : false;
    }

    //Mảng chứa số trang hiển thị trên thanh điều hướng phân trang với số lượng trang (default là 3)
    public function getPages(int $length = 3): array {
        //Nửa độ dài của thanh điều hướng phân trang (để xác định phạm vi của các trang được hiển thị trước và sau trang hiện tại.)
        $halfLength = floor($length / 2); //Nửa độ dài của thanh điều hướng phân trang = làm tròn xuống (số lượng trang / 2)
        $pageStart = $this->currentPage - $halfLength;
        $pageEnd = $this->currentPage + $halfLength;

        // Nếu thanh điều hướng phân trang bắt đầu từ trang âm
        if($pageStart < 1) {
            $pageStart = 1;
            $pageEnd = $length;
        }

        // Nếu thanh điều hướng phân trang kết thúc sau tổng số trang
        if($pageEnd > $this->totalPages) {
            $pageEnd = $this->totalPages;

            $pageStart = $pageEnd - $length + 1;
            if($pageStart < 1) { //Nếu pageStart âm
                $pageStart = 1;
            }
        }

        return range((int)$pageStart, (int)$pageEnd);
    }

}