<?php namespace App\Database\Seeds;

class SampleBlog extends \CodeIgniter\Database\Seeder
{
        public function run()
        {
                $data = [
                        'blog_id' => '',
                        'blog_title'    => 'Sample Blog Title',
                        'blog_description'    => 'Sample Blog Description',
                ];

                // Simple Queries
                $this->db->query("INSERT INTO blog (blog_id, blog_title, blog_description) VALUES(:blog_id:, :blog_title:, :blog_description:)",
                    $data
                );

                // Using Query Builder
                // $this->db->table('blog')->insert($data);
        }
}