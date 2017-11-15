<?php
class Database extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function recreate()
    {
        $database = $this->db->database;
        if ($this->dbforge->drop_database($database))
        {
            echo 'Database dropped!'.PHP_EOL;
        }
        if ($this->dbforge->create_database($database))
        {
            echo 'Database created!'.PHP_EOL;
        }
    }

    public function load() 
    {
        $this->createAdminUser();
        $this->insertAdminUser();

        $this->createCustomer();
        $this->insertCustomer();

        $this->createCms();
        $this->insertCms();
    }

    public function createAdminUser()
    {
        // admin_user
        $this->dbforge->add_field('id');
        $this->dbforge->add_field('firstname varchar(255) NULL');
        $this->dbforge->add_field('lastname varchar(255) NULL');
        $this->dbforge->add_field('email varchar(255) NULL');
        $this->dbforge->add_field('username varchar(255) NULL');
        $this->dbforge->add_field('is_active TINYINT(5) NULL DEFAULT 1');
        $this->dbforge->add_field('password_hash varchar(255) NULL');
        $this->dbforge->add_field('created_at timestamp DEFAULT CURRENT_TIMESTAMP');
        $this->dbforge->add_field('updated_at timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
        $this->dbforge->create_table('admin_user', true);

        echo 'Admin tables created!'.PHP_EOL;
    }

    public function insertAdminUser()
    {
        $this->load->model('user_model');
        $this->load->library('encryptor');

        $data = [
            [
                'firstname' => 'Nam',
                'lastname' => 'Luu',
                'email' => 'nam.luuduc@gmail.com',
                'username' => 'namluu',
                'password_hash' => $this->encryptor->getHash('123456')
            ]
        ];
        $this->user_model->insert_batch($data);

        echo 'Admin sample data inserted!'.PHP_EOL;
    }

    public function createCustomer()
    {
        // customer
        $this->dbforge->add_field('id');
        $this->dbforge->add_field('firstname varchar(255) NULL');
        $this->dbforge->add_field('lastname varchar(255) NULL');
        $this->dbforge->add_field('email varchar(255) NULL');
        $this->dbforge->add_field('created_at timestamp DEFAULT CURRENT_TIMESTAMP');
        $this->dbforge->add_field('updated_at timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
        $this->dbforge->add_field('is_active TINYINT(5) NULL DEFAULT 1');
        $this->dbforge->add_field('password_hash varchar(255) NULL');
        $this->dbforge->add_field('dob date NULL');
        $this->dbforge->add_field('confirmation varchar(255) NULL');
        $this->dbforge->add_field('gender TINYINT(5) NULL');
        $this->dbforge->create_table('customer', true);

        echo 'Customer tables created!'.PHP_EOL;
    }

    public function insertCustomer()
    {
        $this->load->model('customer/customer_model', 'customer_model');
        $this->load->library('encryptor');

        $data = [
            [
                'firstname' => 'Nam',
                'lastname' => 'Luu',
                'email' => 'nam.luuduc@gmail.com',
                'password_hash' => $this->encryptor->getHash('123456')
            ]
        ];
        $this->customer_model->insert_batch($data);

        echo 'Customer sample data inserted!'.PHP_EOL;
    }

    /*public function createProduct()
    {
        $this->dbforge->add_field('id');
        $this->dbforge->add_field('sku varchar(255) NULL');
        $this->dbforge->add_field('type_id varchar(255) NULL');
        $this->dbforge->add_field('is_active TINYINT(5) NULL DEFAULT 1');
        $this->dbforge->add_field('sort_order TINYINT(5) NULL DEFAULT 0');
        $this->dbforge->add_field('visibility TINYINT(5) NULL DEFAULT 1');
        $this->dbforge->add_field('created_at timestamp DEFAULT CURRENT_TIMESTAMP');
        $this->dbforge->add_field('updated_at timestamp DEFAULT CURRENT_TIMESTAMP');
        $this->dbforge->create_table('catalog_product', true);
    }*/

    public function createCms()
    {
        // category
        $this->dbforge->add_field('id');
        $this->dbforge->add_field('title varchar(255) NULL');
        $this->dbforge->add_field('alias varchar(255) NULL');
        $this->dbforge->add_field('description text NULL');
        $this->dbforge->add_field('is_active TINYINT(5) NULL DEFAULT 1');
        $this->dbforge->add_field('sort_order TINYINT(5) NULL DEFAULT 0');
        $this->dbforge->create_table('cms_category', true);

        // article
        $this->dbforge->add_field('id');
        $this->dbforge->add_field('title varchar(255) NULL');
        $this->dbforge->add_field('alias varchar(255) NULL');
        $this->dbforge->add_field('content text NULL');
        $this->dbforge->add_field('created_at timestamp DEFAULT CURRENT_TIMESTAMP');
        $this->dbforge->add_field('updated_at timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
        $this->dbforge->add_field('category_id INT(10) NOT NULL');
        $this->dbforge->add_field('author_id INT(10) NOT NULL');
        $this->dbforge->add_field('is_active TINYINT(5) NULL DEFAULT 1');
        $this->dbforge->add_field('sort_order TINYINT(5) NULL DEFAULT 0');
        $this->dbforge->add_field('is_hot TINYINT(5) NULL DEFAULT 0');
        $this->dbforge->create_table('cms_article', true);

        echo 'CMS tables created!'.PHP_EOL;
    }

    public function insertCms()
    {
        $this->load->model('cms/category_model', 'category_model');
        $this->load->model('cms/article_model', 'article_model');

        $data = [
            ['title' => 'Tin thị trường', 'alias' => string_url_safe('Tin thị trường')],
            ['title' => 'Phân tích', 'alias' => string_url_safe('Phân tích')],
            ['title' => 'Thông tin quy hoạch', 'alias' => string_url_safe('Thông tin quy hoạch')],
            ['title' => 'Tư vấn luật', 'alias' => string_url_safe('Tư vấn luật')],
            ['title' => 'Lời khuyên', 'alias' => string_url_safe('Lời khuyên')]
        ];
        $cate_id1 = $this->category_model->insert_batch($data);

        $data = array();
        for ($i = 0; $i < 50; $i++) {
            $data[] = array(
                'title' => 'Đường hầm metro đầu tiên của Việt Nam đã hoàn thành '.$i,
                'alias' => string_url_safe('Đường hầm metro đầu tiên của Việt Nam đã hoàn thành '.$i),
                'content' => 'Sau hơn 5 tháng thi công, 781m hầm (từ ga Ba Son đến ga Nhà hát thành phố) thuộc tuyến metro Bến Thành - Suối Tiên đã được hình thành, vượt tiến độ 1 tháng.

                    Theo thống kê EPI năm 2016, quốc đảo Seychelles gồm 115 hòn đảo ở phía tây Ấn Độ Dương có chất lượng không khí đạt 98,24 điểm, đứng đầu danh sách 180 quốc gia, theo sau là Trinidad và Tobago (97,2 điểm) và Maldives (97,1 điểm).

                    Với dân số 93.000 người, kể từ năm 2010, quốc gia này đặc biệt chú trọng vào các hoạt động bảo vệ môi trường để đảm bảo người dân được sống trong điều kiện sạch sẽ, khỏe mạnh và cân bằng sinh thái, theo Seychelles News Agency.

                    Trong nhiều năm qua, Seychelles không dùng than đá và dầu mỏ để nấu ăn. Cách thức phát triển kinh tế của chính phủ đóng vai trò quan trọng trong việc bảo vệ không khí sạch cho quần đảo, theo Bộ trưởng Môi trường.

                    "Ngay khi vừa bước ra khỏi máy bay, ấn tượng đầu tiên của tôi là bầu không khí trong lành của đất nước xinh đẹp này", một du khách Trung Quốc chia sẻ.

                    Cũng theo bảng thống kê này, Việt Nam có chất lượng không khí xếp thứ 170/180 với chỉ số EPI là 54,76 điểm và nằm trong tốp 11 quốc gia có chất lượng không khí thấp nhất thế giới.',
                'category_id' => $i % 5 + 1
            );
        }
        $data[] = array(
            'title' => 'Test tiêu đề \'single quote\' and "doule quote", special ?? @!*&',
            'alias' => string_url_safe('Test tiêu đề \'single quote\' and "doule quote", special ?? @!*&'),
            'content' => 'Chỉ số EPI đánh giá sự hiệu quả trong hoạt động bảo vệ môi trường của các quốc gia, được các nhà nghiên cứu tại Đại học Yale, Mỹ, xếp hạng hai năm một lần',
            'category_id' => $i % 5 + 1
        );

        $this->article_model->insert_batch($data);

        echo 'CMS sample data inserted!'.PHP_EOL;
    }

    

}