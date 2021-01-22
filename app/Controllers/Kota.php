<?php

namespace App\Controllers;

use App\Models\kotaModel;

class Kota extends BaseController
{
    protected $kotaModel;
    public function __construct()
    {
        $this->kotaModel = new kotaModel();
    }
    public function index()
    {
        //$kota = $this->kotaModel->findAll();
        $data = [
            'title' => 'daftar kota',
            'kota' => $this->kotaModel->getKota()
        ];

        //$kotaModel = new \App\Models\kotaModel()

        //$kotaModel = new kotaModel();

        return view('kota/index', $data);
    }

    public function detail($provinsi)
    {
        $data = [
            'title' => 'Detail Kota',
            'kota' => $this->kotaModel->getKota($provinsi)
        ];

        //jika kota tidak ada ditabel
        if (empty($data['kota'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama Kota ' . $provinsi . ' tidak ditemukan.');
        }
        return view('kota/detail', $data);
    }
    public function create()
    {
        //session();
        $data = [
            'title' => 'Form Tambah Data Kota',
            'validation' => \Config\Services::validation()
        ];

        return view('kota/create', $data);
    }
    public function save()
    {
        //validasi input
        if (!$this->validate([
            'kota' => [
                'rules' => 'required|is_unique[kota.kota]',
                'errors' => [
                    'required' => '{field} Kota harus diisi.',
                    'is_unique' => '{field} Kota tidak boleh sama'
                ]
            ],
            'icon' => [
                'rules' => 'max_size[icon,1024]|is_image[icon]|mime_in[icon,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/kota/create')->withInput()->with('validation', $validation);
            return redirect()->to('/kota/create')->withInput();
        }

        //ambil gambar
        $file_icon = $this->request->getFile('icon');
        //apakah tidak ada gambar yang diupload
        if ($file_icon->getError() == 4) {
            $nama_icon = 'surabaya.jpg';
        } else {
            //generate nama cicon random
            $nama_icon = $file_icon->getRandomName();
            //pindahkan file ke folder img
            $file_icon->move('img');
        }

        $provinsi = url_title($this->request->getVar('kota'), '-', true);
        $this->kotaModel->save([
            'kota' => $this->request->getVar('kota'),
            'provinsi' => $provinsi,
            'sejarah' => $this->request->getVar('sejarah'),
            'icon' => $nama_icon
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan..');

        return redirect()->to('/kota');
    }
    public function delete($id)
    {

        //cari gambar berdasarkan id
        $kota = $this->kotaModel->find($id);

        //jika file default kehapus
        if ($kota['icon'] != 'surabaya.jpg') {
            //hapus gambar
            unlink('img/' . $kota['icon']);
        }


        $this->kotaModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus..');
        return redirect()->to('/kota');
    }
    public function edit($provinsi)
    {
        $data = [
            'title' => 'Form Ubah Data Kota',
            'validation' => \Config\Services::validation(),
            'kota' => $this->kotaModel->getKota($provinsi)
        ];

        return view('kota/edit', $data);
    }

    public function update($id)
    {
        // cek judul
        $kotalama = $this->kotaModel->getKota($this->request->getVar('provinsi'));
        if ($kotalama['kota'] == $this->request->getVar('kota')) {
            $rule_kota = 'required';
        } else {
            $rule_kota = 'required|is_unique[kota.kota]';
        }

        if (!$this->validate([
            'kota' => [
                'rules' => $rule_kota,
                'errors' => [
                    'required' => '{field} Kota harus diisi.',
                    'is_unique' => '{field} Kota tidak boleh sama'
                ]
            ],
            'icon' => [
                'rules' => 'max_size[icon,1024]|is_image[icon]|mime_in[icon,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->to('/kota/edit/' . $this->request->getVar('provinsi'))->withInput();
        }

        $fileIcon = $this->request->getFile('icon');

        //cek gambar apakah tetap gambar lama
        if ($fileIcon->getError() == 4) {
            $namaIcon = $this->request->getVar('iconLama');
        } else {
            //generate nama file random
            $namaIcon = $fileIcon->getRandomName();
            //pindahkan gambar
            $fileIcon->move('img', $namaIcon);
            //hapus file lama
            unlink('img/' . $this->request->getVar('iconLama'));
        }


        $provinsi = url_title($this->request->getVar('kota'), '-', true);
        $this->kotaModel->save([
            'id' => $id,
            'kota' => $this->request->getVar('kota'),
            'provinsi' => $provinsi,
            'sejarah' => $this->request->getVar('sejarah'),
            'icon' => $namaIcon
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah..');

        return redirect()->to('/kota');
    }
}
