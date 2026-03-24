CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'chairman', 'member', 'accountant', 'manager', 'university_manager') DEFAULT 'member',
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    structure VARCHAR(255),
    photo VARCHAR(255),
    type VARCHAR(50),
    nin VARCHAR(20),
    matricule VARCHAR(50) UNIQUE,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    nom_ar VARCHAR(255),
    prenom_ar VARCHAR(255),
    ssn VARCHAR(12) UNIQUE,
    date_naissance DATE,
    num_compte VARCHAR(100),
    position VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS mandates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    start_date DATE,
    end_date DATE,
    budget DECIMAL(15, 2) DEFAULT 0,
    is_active BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS babs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    type ENUM('grant', 'loan_full', 'loan_partial')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS grants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bab_id INT,
    name VARCHAR(255),
    amount DECIMAL(15, 2),
    conditions TEXT,
    required_documents TEXT,
    repayment_percentage DECIMAL(5, 2) DEFAULT 0,
    installments_count INT DEFAULT 0,
    FOREIGN KEY (bab_id) REFERENCES babs(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT,
    grant_id INT,
    mandate_id INT,
    file_path VARCHAR(255),
    status ENUM('pending', 'beneficiary', 'rejected_temp', 'rejected_final') DEFAULT 'pending',
    rejection_reason TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (employee_id) REFERENCES employees(id),
    FOREIGN KEY (grant_id) REFERENCES grants(id),
    FOREIGN KEY (mandate_id) REFERENCES mandates(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    request_id INT,
    user_id INT,
    amount DECIMAL(15, 2),
    bank_fees DECIMAL(10, 2) DEFAULT 0,
    payment_date DATE,
    reference_number VARCHAR(100),
    FOREIGN KEY (request_id) REFERENCES requests(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS installments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    payment_id INT,
    amount DECIMAL(15, 2),
    due_date DATE,
    is_paid BOOLEAN DEFAULT FALSE,
    paid_at TIMESTAMP NULL,
    FOREIGN KEY (payment_id) REFERENCES payments(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS virements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    beneficiary_count INT NOT NULL,
    total_amount DECIMAL(15, 2) NOT NULL,
    bank_fees DECIMAL(15, 2) DEFAULT 0,
    transfer_date DATE NOT NULL,
    beneficiary_ids TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE payments ADD COLUMN IF NOT EXISTS virement_id INT DEFAULT NULL;
ALTER TABLE payments ADD FOREIGN KEY (virement_id) REFERENCES virements(id) ON DELETE SET NULL;
