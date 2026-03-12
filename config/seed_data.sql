-- INSERT DEFAULT USERS (Password is 'password' for all)
-- Use password_hash('password', PASSWORD_DEFAULT) in PHP to generate these
INSERT INTO users (name, email, password, role, is_active) VALUES
('مدير النظام', 'admin@social.dz', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 1),
('رئيس اللجنة', 'chairman@social.dz', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'chairman', 1),
('محاسب اللجنة', 'accountant@social.dz', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'accountant', 1),
('عضو لجنة', 'member@social.dz', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'member', 1);

-- INSERT SAMPLE DATA
INSERT INTO babs (name, type) VALUES ('هبات لا ترد', 'grant'), ('سلفيات', 'loan_full');
INSERT INTO grants (bab_id, name, amount, repayment_percentage, installments_count) VALUES (1, 'منحة زواج', 30000.00, 0, 0), (2, 'سلفة زواج', 50000.00, 100, 10);
INSERT INTO mandates (name, start_date, end_date, budget, is_active) VALUES ('عهدة 2024/2027', '2024-01-01', '2027-12-31', 1000000.00, 1);
