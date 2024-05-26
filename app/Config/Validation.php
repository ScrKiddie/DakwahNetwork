<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;
use App\CustomValidation\CustomRules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        CustomRules::class
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];
    public array $penyelenggaraRules= [
        'email' => [
            'rules' => 'required|valid_email|max_length[255]|is_unique[penyelenggara.email]',
            'errors' => [
                'required' => 'Email wajib diisi.',
                'valid_email' => 'Masukkan format alamat email yang valid.',
                'max_length' => 'Email tidak boleh lebih dari 255 karakter.',
                'is_unique' => 'Email sudah terdaftar. Silakan pilih yang lain.'
            ]
        ],
        'username' => [
            'rules' => 'required|min_length[3]|max_length[50]|is_unique[penyelenggara.username]',
            'errors' => [
                'required' => 'Username wajib diisi.',
                'min_length' => 'Username harus terdiri dari minimal 3 karakter.',
                'max_length' => 'Username tidak boleh lebih dari 50 karakter.',
                'is_unique' => 'Username sudah terdaftar. Silakan pilih yang lain.'
            ]
        ],
        'password' => [
            'rules' => 'required|min_length[8]|max_length[255]',
            'errors' => [
                'required' => 'Password wajib diisi.',
                'min_length' => 'Password harus terdiri dari minimal 8 karakter.',
                'max_length' => 'Password tidak boleh lebih dari 255 karakter.'
            ]
        ],
        'namaLembaga' => [
            'rules' => 'required|max_length[255]|is_unique[penyelenggara.namaLembaga]',
            'errors' => [
                'required' => 'Nama Lembaga wajib diisi.',
                'max_length' => 'Nama Lembaga tidak boleh lebih dari 255 karakter.',
                'is_unique' => 'Nama Lembaga sudah terdaftar. Silakan pilih yang lain.'
            ]
        ],
        'alamatLembaga' => [
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => 'Alamat Lembaga wajib diisi.',
                'max_length' => 'Alamat Lembaga tidak boleh lebih dari 255 karakter.'
            ]
        ],
        'noTelp' => [
            'rules' => 'required|numeric|min_length[10]|max_length[15]|is_unique[penyelenggara.noTelp]',
            'errors' => [
                'required' => 'Nomor Telepon wajib diisi.',
                'numeric' => 'Nomor Telepon harus berupa angka yang valid.',
                'min_length' => 'Nomor Telepon harus terdiri dari minimal 10 digit.',
                'max_length' => 'Nomor Telepon tidak boleh lebih dari 15 digit.',
                'is_unique' => 'Nomor Telepon sudah terdaftar. Silakan pilih yang lain.'
            ]
        ],
    ];
    public array $idPenyelenggaraRule=[
        'id' => [
            'rules' => 'required|is_natural_no_zero|is_not_unique[penyelenggara.id]',
            'errors' => [
                'required' => 'ID wajib diisi.',
                'is_not_unique' => 'ID tidak ditemukan di database.'
            ]
        ]
    ];

    public array $fileRule=[
        'profilePict' => [
            'rules' => 'ext_in[profilePict,png,jpg,jpeg]|max_size[profilePict,5120]|max_dims[profilePict,400,400]',
            'errors' => [
                'ext_in' => 'Ekstensi file foto profil harus .png, .jpg, atau .jpeg.',
                'max_size' => 'Ukuran file foto profil tidak boleh lebih dari 5MB.',
                'max_dims' => 'Dimensi file harus 400:400.'
            ]
        ]
    ];

    public array $editPenyelenggaraRules= [
        'id' => [
            'rules' => 'required|is_natural_no_zero|is_not_unique[penyelenggara.id]',
            'errors' => [
                'required' => 'ID wajib diisi.',
                'is_not_unique' => 'ID tidak ditemukan di database.'
            ]
        ],
        'email' => [
            'rules' => 'required|valid_email|max_length[255]|is_unique[penyelenggara.email,id,{id}]',
            'errors' => [
                'required' => 'Email wajib diisi.',
                'valid_email' => 'Masukkan format alamat email yang valid.',
                'max_length' => 'Email tidak boleh lebih dari 255 karakter.',
                'is_unique' => 'Email sudah terdaftar. Silakan pilih yang lain.'
            ]
        ],
        'username' => [
            'rules' => 'required|min_length[3]|max_length[50]|is_unique[penyelenggara.username,id,{id}]',
            'errors' => [
                'required' => 'Username wajib diisi.',
                'min_length' => 'Username harus terdiri dari minimal 3 karakter.',
                'max_length' => 'Username tidak boleh lebih dari 50 karakter.',
                'is_unique' => 'Username sudah terdaftar. Silakan pilih yang lain.'
            ]
        ],
        'password' => [
            'rules' => 'permit_empty|min_length[8]|max_length[255]',
            'errors' => [
                'min_length' => 'Password harus terdiri dari minimal 8 karakter.',
                'max_length' => 'Password tidak boleh lebih dari 255 karakter.'
            ]
        ],
        'namaLembaga' => [
            'rules' => 'required|max_length[255]|is_unique[penyelenggara.namaLembaga,id,{id}]',
            'errors' => [
                'required' => 'Nama Lembaga wajib diisi.',
                'max_length' => 'Nama Lembaga tidak boleh lebih dari 255 karakter.',
                'is_unique' => 'Nama Lembaga sudah terdaftar. Silakan pilih yang lain.'
            ]
        ],
        'alamatLembaga' => [
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => 'Alamat Lembaga wajib diisi.',
                'max_length' => 'Alamat Lembaga tidak boleh lebih dari 255 karakter.'
            ]
        ],
        'noTelp' => [
            'rules' => 'required|numeric|min_length[10]|max_length[15]|is_unique[penyelenggara.noTelp,id,{id}]',
            'errors' => [
                'required' => 'Nomor Telepon wajib diisi.',
                'numeric' => 'Nomor Telepon harus berupa angka yang valid.',
                'min_length' => 'Nomor Telepon harus terdiri dari minimal 10 digit.',
                'max_length' => 'Nomor Telepon tidak boleh lebih dari 15 digit.',
                'is_unique' => 'Nomor Telepon sudah terdaftar. Silakan pilih yang lain.'
            ]
        ],
    ];

    public $dakwahRules = [
        'judul' => [
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => 'Judul wajib diisi.',
                'max_length' => 'Judul tidak boleh lebih dari 255 karakter.'
            ]
        ],
        'tema' => [
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => 'Tema wajib diisi.',
                'max_length' => 'Tema tidak boleh lebih dari 255 karakter.'
            ]
        ],
        'waktuMulai' => [
            'rules' => 'required|checkDateTimeFormat',
            'errors'=>[
                'required' => 'Waktu mulai wajib diisi.'
            ]
        ],
        'durasi' => [
            'rules' => 'required|integer|checkDuration',
            'errors' => [
                'required' => 'Durasi wajib diisi.',
                'integer' => 'Durasi harus berupa angka.'
            ]
        ],
        'pendakwah' => [
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => 'Nama pendakwah wajib diisi.',
                'max_length' => 'Nama pendakwah tidak boleh lebih dari 255 karakter.'
            ]
        ],
        'deskripsi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Deskripsi tidak boleh kosong.'
            ]
        ],
        'lokasi' => [
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => 'Lokasi tidak boleh kosong.',
                'max_length' => 'Lokasi tidak boleh lebih dari 255 karakter.'
            ]
        ],
        'id_penyelenggara' => [
            'rules' => 'required|integer|is_not_unique[penyelenggara.id]',
            'errors' => [
                'required' => 'Lembaga wajib diisi.',
                'integer' => 'Lembaga tidak ditemukan.',
                'is_not_unique' => 'Lembaga tidak ditemukan.'
            ]
        ]
    ];
    public array $posterAddRule=[
        'posterPict' => [
            'rules' => 'uploaded[posterPict]|ext_in[posterPict,png,jpg,jpeg]|max_size[posterPict,5120]|max_dims[posterPict,480,720]',
            'errors' => [
                'uploaded' =>'File foto poster harus diisi.',
                'ext_in' => 'Ekstensi file foto poster harus .png, .jpg, atau .jpeg.',
                'max_size' => 'Ukuran file foto poster tidak boleh lebih dari 5MB.',
                'max_dims' => 'Dimensi file harus 480:720.'
            ]
        ]
    ];
    public array $posterUpdateRule=[
        'posterPict' => [
            'rules' => 'ext_in[posterPict,png,jpg,jpeg]|max_size[posterPict,5120]|max_dims[posterPict,480,720]',
            'errors' => [
                'ext_in' => 'Ekstensi file foto poster harus .png, .jpg, atau .jpeg.',
                'max_size' => 'Ukuran file foto poster tidak boleh lebih dari 5MB.',
                'max_dims' => 'Dimensi file harus 480:720.'
            ]
        ]
    ];
    public array $idDakwahRule=[
        'id' => [
            'rules' => 'required|is_natural_no_zero|is_not_unique[dakwah.id]',
            'errors' => [
                'required' => 'ID wajib diisi.',
                'is_not_unique' => 'ID tidak ditemukan di database.'
            ]
        ]
    ];
    public array $authRule=[
        'username' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Username harus diisi.',
            ]
        ],
        'password' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Password harus diisi.',
            ]
        ]
    ];

    public array $adminRule=[
        'id' => [
            'rules' => 'required|is_natural_no_zero|is_not_unique[admin.id]',
            'errors' => [
                'required' => 'ID wajib diisi.',
                'is_not_unique' => 'ID tidak ditemukan di database.'
            ]
        ],
        'username' => [
            'rules' => 'required|min_length[5]|max_length[50]|is_unique[admin.username,id,{id}]',
            'errors' => [
                'required' => 'Username wajib diisi.',
                'max_length' => 'Username tidak boleh lebih dari 50 karakter.',
                'min_length' => 'Username harus terdiri dari minimal 5 karakter.',
                'is_unique' => 'Username sudah terdaftar. Silakan pilih yang lain.',
            ]
        ]
    ];

    public array $adminPasswordRule = [
        'id' => [
            'rules' => 'required|is_natural_no_zero|is_not_unique[admin.id]',
            'errors' => [
                'required' => 'ID wajib diisi.',
                'is_not_unique' => 'ID tidak ditemukan di database.'
            ]
        ],
        'oldPass' => [
            'rules' => 'required|is_not_unique[admin.password,id,{id}]',
            'errors' => [
                'required' => 'Password wajib diisi.',
                'is_not_unique' => 'Password lama yang anda masukkan salah.'
            ]
        ],
        'newPass' => [
            'rules' => 'required|min_length[5]|max_length[255]',
            'errors' => [
                'required' => 'Password baru wajib diisi.',
                'min_length' => 'Password baru harus terdiri dari minimal 5 karakter.',
                'max_length' => 'Password baru tidak boleh lebih dari 255 karakter.'
            ]
        ],
        'repeatNewPass' => [
            'rules' => 'required|matches[newPass]',
            'errors' => [
                'required' => 'Password ulang wajib diisi.',
                'matches' => 'Password baru dan ulang password tidak cocok.'
            ]
        ],
    ];

    public array $idDakwahRuleUser=[
        'id_penyelenggara' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'id_penyelenggara wajib diisi.',
            ]
        ],
        'id' => [
            'rules' => 'required|is_natural_no_zero|is_not_unique[dakwah.id,id_penyelenggara,{id_penyelenggara}]',
            'errors' => [
                'required' => 'ID dakwah wajib diisi.',
                'is_not_unique' => 'ID tidak ditemukan di database.'
            ]
        ]
    ];
    public array $userPasswordRule = [
        'id' => [
            'rules' => 'required|is_natural_no_zero|is_not_unique[penyelenggara.id]',
            'errors' => [
                'required' => 'ID wajib diisi.',
                'is_not_unique' => 'ID tidak ditemukan di database.'
            ]
        ],
        'oldPass' => [
            'rules' => 'required|is_not_unique[penyelenggara.password,id,{id}]',
            'errors' => [
                'required' => 'Password wajib diisi.',
                'is_not_unique' => 'Password lama yang anda masukkan salah.'
            ]
        ],
        'newPass' => [
            'rules' => 'required|min_length[5]|max_length[255]',
            'errors' => [
                'required' => 'Password baru wajib diisi.',
                'min_length' => 'Password baru harus terdiri dari minimal 5 karakter.',
                'max_length' => 'Password baru tidak boleh lebih dari 255 karakter.'
            ]
        ],
        'repeatNewPass' => [
            'rules' => 'required|matches[newPass]',
            'errors' => [
                'required' => 'Password ulang wajib diisi.',
                'matches' => 'Password baru dan ulang password tidak cocok.'
            ]
        ],
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
}
