<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

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
            'rules' => 'required|valid_email|max_length[255]|is_unique[penyelenggara.username]',
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
            'rules' => 'required|numeric|min_length[10]|max_length[15]',
            'errors' => [
                'required' => 'Nomor Telepon wajib diisi.',
                'numeric' => 'Nomor Telepon harus berupa angka yang valid.',
                'min_length' => 'Nomor Telepon harus terdiri dari minimal 10 digit.',
                'max_length' => 'Nomor Telepon tidak boleh lebih dari 15 digit.'
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
            'rules' => 'required|valid_email|max_length[255]|is_unique[penyelenggara.username,id,{id}]',
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
            'rules' => 'required|numeric|min_length[10]|max_length[15]',
            'errors' => [
                'required' => 'Nomor Telepon wajib diisi.',
                'numeric' => 'Nomor Telepon harus berupa angka yang valid.',
                'min_length' => 'Nomor Telepon harus terdiri dari minimal 10 digit.',
                'max_length' => 'Nomor Telepon tidak boleh lebih dari 15 digit.'
            ]
        ],
    ];





    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
}
