const puppeteer = require('puppeteer');
const path = require('path');

(async () => {
    const browser = await puppeteer.launch({
        headless: 'new',
        args: ['--no-sandbox', '--disable-setuid-sandbox']
    });

    const page = await browser.newPage();

    const htmlPath = path.join(__dirname, 'presentation', 'index.html');
    const fileUrl = 'file:///' + htmlPath.replace(/\\/g, '/');

    await page.goto(fileUrl, { waitUntil: 'networkidle0' });

    // Wait for fonts to load
    await new Promise(resolve => setTimeout(resolve, 2000));

    await page.pdf({
        path: 'QAJET_Presentation.pdf',
        width: '297mm',
        height: '210mm',
        printBackground: true,
        preferCSSPageSize: true,
    });

    await browser.close();

    console.log('✅ PDF created: QAJET_Presentation.pdf');
})();
