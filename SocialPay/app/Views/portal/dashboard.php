<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>بوابة الموظف</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand">مرحباً <?= $employee['nom_ar']; ?></span>
            <div class="navbar-nav">
                <a class="nav-link" href="/portal/logout">خروج</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-8">
                <h4>المنح والطلبات المتاحة</h4>
                <div class="row">
                    <?php foreach($grants as $g): ?>
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5><?= $g['name']; ?></h5>
                                <p class="text-muted mb-1"><?= $g['bab_name']; ?></p>
                                <p class="fw-bold text-primary"><?= number_format($g['amount'], 2); ?> دج</p>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modal<?= $g['id']; ?>">تفاصيل وتقديم</button>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="modal<?= $g['id']; ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="/portalDashboard/submitRequest" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="grant_id" value="<?= $g['id']; ?>">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">تقديم طلب: <?= $g['name']; ?></h5>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>الشروط:</strong> <?= $g['conditions']; ?></p>
                                            <p><strong>الوثائق:</strong> <?= $g['required_documents']; ?></p>
                                            <div class="mb-3">
                                                <label class="form-label">تحميل الملف (PDF)</label>
                                                <input type="file" name="pdf" class="form-control" accept=".pdf" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                            <button type="submit" class="btn btn-primary">تأكيد الطلب</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-4">
                <h4>طلباتك السابقة</h4>
                <div class="list-group">
                    <?php foreach($requests as $r): ?>
                    <div class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1"><?= $r['grant_name']; ?></h6>
                            <small><?= date('Y-m-d', strtotime($r['created_at'])); ?></small>
                        </div>
                        <p class="mb-1">الحالة:
                            <span class="badge bg-<?= $r['status'] == 'beneficiary' ? 'success' : ($r['status'] == 'pending' ? 'warning text-dark' : 'danger'); ?>">
                                <?= $r['status'] == 'pending' ? 'قيد الدراسة' : ($r['status'] == 'beneficiary' ? 'مستفيد' : 'مرفوض'); ?>
                            </span>
                        </p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
