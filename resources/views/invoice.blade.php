<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فاتورة - ندى بسام المقيد</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0f172a;
            --accent: #2563eb;
            --accent-soft: #eff6ff;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #334155;
            --text-muted: #64748b;
            --border: #e2e8f0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Tajawal', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: var(--bg);
            color: var(--text-main);
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .invoice-container {
            background: var(--card-bg);
            width: 100%;
            max-width: 850px;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .top-bar {
            height: 6px;
            background: linear-gradient(90deg, #2563eb, #3b82f6, #60a5fa);
        }

        .invoice-header {
            padding: 40px 40px 25px 40px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 1px solid var(--border);
        }

        .brand h1 {
            font-size: 26px;
            font-weight: 800;
            color: var(--primary);
        }

        .brand .subtitle {
            font-size: 14px;
            color: var(--accent);
            font-weight: 700;
            margin-top: 4px;
        }

        .invoice-title h2 {
            font-size: 32px;
            font-weight: 800;
            color: var(--primary);
        }

        .invoice-badge {
            display: inline-block;
            background: var(--accent-soft);
            color: var(--accent);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            margin-top: 6px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            padding: 25px 40px;
            background-color: #fafafa;
            border-bottom: 1px solid var(--border);
        }

        .info-box h3 {
            font-size: 12px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 8px;
            font-weight: 700;
        }

        .info-box p {
            font-size: 15px;
            color: var(--primary);
            font-weight: 700;
        }

        .info-box span {
            display: block;
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .dates-box {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            background: #ffffff;
            padding: 15px;
            border-radius: 10px;
            border: 1px solid var(--border);
        }

        .date-item .label {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 700;
        }

        .date-item .value {
            font-size: 14px;
            color: var(--primary);
            font-weight: 700;
            margin-top: 2px;
        }

        .project-banner {
            margin: 25px 40px 10px 40px;
            padding: 16px 20px;
            background: var(--accent-soft);
            border-right: 4px solid var(--accent);
            border-radius: 6px;
        }

        .project-banner .label {
            font-size: 12px;
            color: var(--accent);
            font-weight: 700;
        }

        .project-banner .title {
            font-size: 16px;
            color: var(--primary);
            font-weight: 800;
            margin-top: 2px;
        }

        .table-container {
            padding: 20px 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: right;
        }

        th {
            background-color: var(--bg);
            color: var(--text-muted);
            font-size: 12px;
            font-weight: 700;
            padding: 12px 16px;
            border-bottom: 2px solid var(--border);
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
        }

        td.desc {
            font-weight: 700;
            color: var(--primary);
        }

        td.desc span {
            display: block;
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 400;
            margin-top: 3px;
        }

        .amount-col {
            text-align: left;
            font-weight: 700;
        }

        .summary-section {
            padding: 10px 40px 25px 40px;
            display: flex;
            justify-content: flex-end;
        }

        .total-card {
            width: 320px;
            background: var(--primary);
            color: #ffffff;
            padding: 18px 22px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-card .amount {
            font-size: 24px;
            font-weight: 800;
        }

        .invoice-footer {
            padding: 25px 40px;
            background-color: #fafafa;
            border-top: 1px solid var(--border);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .footer-block h4 {
            font-size: 13px;
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 10px;
        }

        .footer-block p, .footer-block ul {
            font-size: 12px;
            color: var(--text-muted);
            line-height: 1.6;
            list-style: none;
        }

        .footer-block ul li {
            margin-bottom: 6px;
            position: relative;
            padding-right: 14px;
        }

        .footer-block ul li::before {
            content: "•";
            color: var(--accent);
            font-weight: bold;
            position: absolute;
            right: 0;
        }

        @media print {
            body { background: white; padding: 0; }
            .invoice-container { box-shadow: none; border: none; max-width: 100%; }
            .print-btn { display: none; }
        }

        .actions { text-align: center; margin-top: 20px; }
        .print-btn {
            background-color: var(--accent);
            color: white;
            border: none;
            padding: 10px 24px;
            font-size: 14px;
            font-weight: 700;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div style="width: 100%; max-width: 850px;">
        <div class="invoice-container">
            <div class="top-bar"></div>
            
            <div class="invoice-header">
                <div class="brand">
                    <h1>ندى بسام المقيد</h1>
                    <div class="subtitle">مستقلة / تطوير وحلول برمجية</div>
                </div>
                <div class="invoice-title">
                    <h2>فاتورة</h2>
                    <div class="invoice-badge">#INV-2026-001</div>
                </div>
            </div>

            <div class="info-grid">
                <div class="info-box">
                    <h3>مُقدمة إلى (العميل)</h3>
                    <p>[اسم العميل / الشركة]</p>
                    <span>البريد: client@example.com</span>
                </div>
                
                <div class="dates-box">
                    <div class="date-item">
                        <div class="label">تاريخ الفاتورة</div>
                        <div class="value">24 أغسطس 2026</div>
                    </div>
                    <div class="date-item">
                        <div class="label">تاريخ الاستحقاق</div>
                        <div class="value" style="color: #d97706;">07 سبتمبر 2026</div>
                    </div>
                </div>
            </div>

            <div class="project-banner">
                <div class="label">عنوان المشروع</div>
                <div class="title">[اسم المشروع، مثال: تطوير وتصميم نظام برمجي متكامل]</div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 48%;">الخدمات المقدمة / تفكيك الجزئيات</th>
                            <th style="text-align: center;">الكمية</th>
                            <th style="text-align: center;">السعر الفردي</th>
                            <th style="text-align: left;">المجموع</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="desc">
                                بناء قواعد البيانات والتصميم الهيكلي (Database Architecture)
                                <span>تصميم المخطط واستحداث الجداول والعلاقات الأساسية لضمان الأداء الأفضل.</span>
                            </td>
                            <td style="text-align: center;">1</td>
                            <td style="text-align: center;">$400</td>
                            <td style="text-align: left; font-weight:700;">$400</td>
                        </tr>
                        <tr>
                            <td class="desc">
                                تطوير الواجهات الخلفية وبناء RESTful APIs
                                <span>تطوير متحكمات النظام، حماية المسارات، وتطبيق قواعد العمل التجارية.</span>
                            </td>
                            <td style="text-align: center;">1</td>
                            <td style="text-align: center;">$800</td>
                            <td style="text-align: left; font-weight:700;">$800</td>
                        </tr>
                        <tr>
                            <td class="desc">
                                ربط بوابات الدفع الإلكتروني وتكامل الخدمات
                                <span>تكامل آمن لمعالجة المعاملات المالية والدفع الفوري واختبار الأمان.</span>
                            </td>
                            <td style="text-align: center;">1</td>
                            <td style="text-align: center;">$300</td>
                            <td style="text-align: left; font-weight:700;">$300</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="summary-section">
                <div class="total-card">
                    <div>المبلغ الإجمالي المستحق</div>
                    <div class="amount">$1,500</div>
                </div>
            </div>

            <div class="invoice-footer">
                <div class="footer-block">
                    <h4>💳 طرق وملاحظات الدفع</h4>
                    <p><strong>تحويل بنكي / Bank Transfer:</strong><br>
                       اسم الحساب: Nada Bassam Almoqayad<br>
                       IBAN: PS00 0000 0000 0000 0000 0000
                    </p>
                    <p style="margin-top: 8px;">
                       <strong>PayPal / Payoneer:</strong><br>
                       nada.email@example.com
                    </p>
                </div>
                
                <div class="footer-block">
                    <h4>⚖️ شروط الدفع وحماية الحقوق</h4>
                    <ul>
                        <li><strong>سقف التعديلات:</strong> تشمل الفاتورة <strong>(3) جولات تعديل مجانية</strong> محددة بالبنود المتفق عليها، وأي تعديل إضافي يتم احتسابه بتكلفة مستقلة.</li>
                        <li><strong>الدعم الفني:</strong> يتضمن المشروع <strong>دعمًا فنيًا مجانيًا لمدة (أسبوع واحد)</strong> بعد التسليم لإصلاح أي أخطاء برمجية.</li>
                        <li><strong>العمولات واستحقاق الدفع:</strong> يُرجى الدفع في أو قبل 07 سبتمبر 2026. يتحمل العميل أي رسوم تحويل بنكي لضمان وصول المبلغ كاملًا.</li>
                        <li><strong>الملكية:</strong> انتقال ملكية الكود والمخرجات للعميل مرهون بتحصيل المبلغ المتبقي بالكامل.</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="actions">
            <button class="print-btn" onclick="window.print()">طباعة / حفظ كـ PDF</button>
        </div>
    </div>

</body>
</html>