# 🚀 Setup & Deployment Commands

Quick reference commands untuk setup dan deploy repository pkaltim.

## 📦 Initial Setup (Local)

### Clone Repository
```bash
git clone https://github.com/ghani-desta/pkaltim.git
cd pkaltim
```

### Verify Structure
```bash
ls -la
# Should show: README.md, docs/, assets/, templates/, teams/, .github/
```

## 🔧 GitHub Setup

### 1. Create Repository on GitHub
```bash
# Via GitHub CLI (if installed)
gh repo create pkaltim --public --source=. --remote=origin

# OR via web: github.com/new
# Name: pkaltim
# Description: Pariwisata Kaltim - SMK 7 Samarinda Mini Project
# Public repository
```

### 2. Push to GitHub
```bash
git add .
git commit -m "Initial commit: Complete project structure for 12 teams"
git branch -M main
git push -u origin main
```

### 3. Enable GitHub Pages
```bash
# Via GitHub CLI
gh repo edit --enable-pages --pages-branch main

# OR via web:
# Settings → Pages → Source: GitHub Actions
```

### 4. Add Discord Webhook (Optional)
```bash
# Settings → Secrets → New repository secret
# Name: DISCORD_WEBHOOK
# Value: https://discord.com/api/webhooks/YOUR_WEBHOOK_URL
```

## 👥 For Students (Fork & PR)

### Fork Repository
```bash
# Via GitHub CLI
gh repo fork ghani-desta/pkaltim --clone

# OR via web: Click "Fork" button
```

### Make Changes
```bash
cd pkaltim

# Edit progress file
nano docs/progress.md

# Add screenshot
cp screenshot.png assets/screenshots/tim-1.png

# Commit changes
git add .
git commit -m "Submit Tim 1 - Wisata Alam Derawan"
git push origin main
```

### Create Pull Request
```bash
# Via GitHub CLI
gh pr create --title "Submit Tim 1 - Wisata Alam" --body "Ready for review"

# OR via web: Click "Contribute" → "Open pull request"
```

## 🎨 For Development (PHP Templates)

### Setup XAMPP
```bash
# Copy templates to htdocs
cp -r templates/* /xampp/htdocs/pkaltim-tim1/

# OR on Windows
xcopy templates C:\xampp\htdocs\pkaltim-tim1\ /E /I
```

### Create Database
```sql
-- Open phpMyAdmin: http://localhost/phpmyadmin
CREATE DATABASE pkaltim_tim1;

-- Import SQL file via GUI
-- Or via command line:
mysql -u root -p pkaltim_tim1 < templates/db-sample.sql
```

### Test Local
```bash
# Start XAMPP services
sudo /opt/lampp/lampp start

# OR on Windows: Open XAMPP Control Panel

# Access: http://localhost/pkaltim-tim1/
```

## 🌐 Deploy to 000webhost

### Via FileZilla (FTP)
```
Host: ftpupload.net
Username: [your-000webhost-username]
Password: [your-password]
Port: 21

Upload all files to: public_html/
```

### Via cPanel File Manager
1. Login to 000webhost control panel
2. File Manager → Upload ZIP
3. Extract ZIP
4. Import database via phpMyAdmin

### Database Config
Edit `config.php` on hosting:
```php
$servername = "localhost";  // Usually localhost
$username = "id12345_user"; // From hosting panel
$password = "yourpassword";
$dbname = "id12345_dbname";
```

## 🔍 Verify Deployment

### Check Website
```bash
curl -I https://yourusername.000webhostapp.com
# Should return: HTTP/1.1 200 OK
```

### Test CRUD
1. Visit: https://yourusername.000webhostapp.com
2. Login as admin
3. Test Create/Read/Update/Delete
4. Check on mobile device

## 🤖 GitHub Actions

### Trigger Manual Deploy
```bash
# Via GitHub CLI
gh workflow run deploy-pages.yml

# OR: Push to main branch (auto-trigger)
git push origin main
```

### View Workflow Status
```bash
gh run list
gh run view [run-id]

# OR via web: Actions tab
```

## 📊 Check Progress

### View Live Page
```bash
# Visit GitHub Pages
https://ghani-desta.github.io/pkaltim

# OR via CLI
gh browse --pages
```

### Check All PRs
```bash
gh pr list --state all

# Review specific PR
gh pr view [PR-number]
gh pr review [PR-number] --approve
```

## 🐛 Troubleshooting

### Reset to Clean State
```bash
# Discard all local changes
git reset --hard origin/main
git clean -fd

# Pull latest
git pull origin main
```

### Fix Merge Conflicts
```bash
# Update fork with upstream
git remote add upstream https://github.com/ghani-desta/pkaltim.git
git fetch upstream
git merge upstream/main

# Resolve conflicts manually
git add .
git commit -m "Merge upstream changes"
git push origin main
```

### Re-deploy GitHub Pages
```bash
# Delete and recreate deployment
gh workflow run deploy-pages.yml --ref main

# Or: Create empty commit to trigger
git commit --allow-empty -m "Trigger Pages rebuild"
git push origin main
```

## 📱 Mobile Testing

### Test Responsive Design
```bash
# Chrome DevTools
F12 → Toggle device toolbar (Ctrl+Shift+M)

# Test devices: iPhone SE, iPad, Desktop HD
```

### BrowserStack (Online)
```
Visit: https://www.browserstack.com/
Test URL: [your-000webhost-url]
```

## 📈 Analytics (Optional)

### Add Google Analytics
```html
<!-- Add to index.php before </head> -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-XXXXXXXXXX');
</script>
```

## 🔒 Security Checklist

Before deploying:
```bash
# Remove sensitive data
grep -r "password" .  # Check for hardcoded passwords
grep -r "localhost" . # Check for local configs

# Update .gitignore
echo "config.php" >> .gitignore  # Don't commit real config
echo "*.env" >> .gitignore

# Set proper permissions
chmod 644 *.php
chmod 755 pages/
```

## 📞 Get Help

### GitHub Issues
```bash
gh issue create --title "Bug: Cannot connect to database" --body "Description..."

# OR via web: Issues → New issue → Choose template
```

### Contact PIC
```bash
# Check PIC assignment
cat docs/progress.md | grep "Tim [your-number]"

# WhatsApp or Discord for urgent issues
```

---

## 🎯 Quick Reference

| Task | Command |
|------|---------|
| Clone repo | `git clone https://github.com/ghani-desta/pkaltim.git` |
| Create branch | `git checkout -b feature/my-feature` |
| Check status | `git status` |
| Commit changes | `git commit -m "message"` |
| Push to GitHub | `git push origin main` |
| Create PR | `gh pr create` |
| View live site | Open https://ghani-desta.github.io/pkaltim |

---

<div align="center">

**📚 More Resources**

[Git Tutorial](https://git-scm.com/docs) • [PHP Docs](https://www.php.net/manual/) • [Bootstrap 5](https://getbootstrap.com/docs/5.3/)

**💡 Pro Tips**

Commit often • Test locally first • Read error messages • Ask for help early!

</div>
