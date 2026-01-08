# 📦 Repository Structure - pkaltim

## 📂 Complete File Structure

```
pkaltim/
├── README.md                          # Main project homepage
├── LICENSE                            # MIT License
├── .gitignore                         # Git ignore rules
│
├── .github/                          # GitHub specific configs
│   ├── workflows/
│   │   ├── deploy-pages.yml         # Auto-deploy to GH Pages
│   │   └── discord-notify.yml       # Discord webhook for PRs
│   ├── ISSUE_TEMPLATE/
│   │   ├── bug-report.md            # Bug report template
│   │   ├── progress-update.md       # Progress tracking template
│   │   └── question.md              # Q&A template
│   └── PULL_REQUEST_TEMPLATE.md     # PR submission template
│
├── docs/                             # Documentation folder
│   ├── TUGAS-MINI-PROJECT.md        # Complete assignment details
│   ├── progress.md                  # 12 teams progress tracking
│   └── submission-guide.md          # How to submit via PR
│
├── assets/                           # Assets folder
│   ├── README.md                    # Assets usage guide
│   └── screenshots/                 # Team screenshots
│       └── README.md                # Screenshot guidelines
│
├── templates/                        # PHP starter templates
│   ├── README.md                    # Template usage guide
│   ├── config.php                   # Database config sample
│   ├── db-sample.sql                # Database schema + data
│   ├── index.php                    # Landing page template
│   └── assets/
│       └── css/
│           └── style.css            # Custom CSS template
│
└── teams/                            # Individual team folders
    ├── tim-01/
    │   └── README.md                # Team 1 info (Wisata Alam)
    ├── tim-02/
    │   └── README.md                # Team 2 info (Kuliner)
    ├── tim-03/
    │   └── README.md                # Team 3 info (Religi)
    ├── ... (tim-04 through tim-11)
    └── tim-12/
        └── README.md                # Team 12 info (Paket Wisata)
```

## 📊 File Count

| Category | Count | Files |
|----------|-------|-------|
| **Documentation** | 6 | README, TUGAS, progress, submission, 2x assets readme |
| **Templates** | 5 | PHP, SQL, CSS, 2x README |
| **GitHub** | 7 | 2 workflows, 3 issue templates, 1 PR template, 1 config |
| **Teams** | 12 | 12 README files (tim-01 to tim-12) |
| **Total** | **30+** | - |

## 🎯 Key Features

### 📝 Documentation
- **README.md** - Comprehensive project overview with badges, progress table, timelines
- **TUGAS-MINI-PROJECT.md** - Detailed assignment with requirements, grading criteria
- **progress.md** - Live tracking of 12 teams with checkpoints
- **submission-guide.md** - Step-by-step PR submission tutorial

### 🎨 Templates
- **PHP Template** - Starter code with Bootstrap 5
- **Database Schema** - MySQL tables with sample Kaltim data
- **CSS Template** - Custom styles with responsive design
- **Config Sample** - PDO database connection

### 🤖 Automation
- **GitHub Actions**
  - Auto-deploy README to GitHub Pages
  - Discord webhook notifications for PR events
- **Issue Templates**
  - Bug reports
  - Progress updates
  - Q&A / Help requests
- **PR Template**
  - Comprehensive submission checklist
  - Self-assessment form
  - Links verification

### 👥 Team Management
- 12 team folders (tim-01 to tim-12)
- Each with README template
- Pre-filled team info based on assignment

## 🚀 Quick Actions

### For Students
```bash
# 1. Fork repository
git fork https://github.com/ghani-desta/pkaltim

# 2. Clone to local
git clone https://github.com/[username]/pkaltim.git

# 3. Work on your team folder
cd teams/tim-[X]/

# 4. Submit via Pull Request
# Edit docs/progress.md → commit → PR
```

### For PIC (Ghani/Widhi/Navies)
- Review PRs in GitHub
- Approve/Request changes
- Merge when ready
- Auto-notify via Discord

### For Kajur (Bapak Hendra)
- Visit: https://ghani-desta.github.io/pkaltim
- See live progress dashboard
- All 12 teams in one place

## 📊 Progress Tracking

### Checkpoints
1. **16 Jan** - Database Design
2. **23 Jan** - CRUD Local
3. **30 Jan** - UI Finalization
4. **5 Feb** - Deploy & Submit

### Status Legend
- 🔄 Setup - Not started
- 🚧 Progress - In development
- ✅ Live - Deployed & submitted
- ❌ Revisi - Needs fixes

## 🎓 Grading Criteria

| Aspect | Weight | Description |
|--------|--------|-------------|
| **Functionality** | 40% | CRUD works, no critical bugs |
| **UI/UX** | 25% | Responsive, user-friendly |
| **Code Quality** | 20% | Clean, documented code |
| **Deployment** | 15% | Live & accessible |
| **Bonus** | +20 | Extra features |

## 📞 Support Channels

### PIC Assignment
- **Ghani Desta** → Tim 5-8
- **Widhi** → Tim 1-4
- **Navies** → Tim 9-12

### Contact Methods
- WhatsApp (primary)
- GitHub Issues (technical)
- Discord (community)

## 🔗 Important Links

- **Repo:** https://github.com/ghani-desta/pkaltim
- **Pages:** https://ghani-desta.github.io/pkaltim
- **Hosting:** 000webhost.com
- **Template Source:** SourceCodester, GitHub

## 📅 Timeline

| Date | Milestone |
|------|-----------|
| **9 Jan 2026** | Kickoff & repo created |
| **16 Jan** | Checkpoint 1 |
| **23 Jan** | Checkpoint 2 |
| **30 Jan** | Checkpoint 3 |
| **5 Feb 2026** | **DEADLINE** |

## ✅ Setup Completed

- [x] Repository structure created
- [x] Documentation written
- [x] Templates prepared
- [x] GitHub Actions configured
- [x] Issue templates created
- [x] PR template created
- [x] Team folders generated
- [x] README badges added
- [x] Progress tracking setup
- [x] Submission guide written

## 🎉 Ready to Launch!

Repository `pkaltim` is now **100% ready** for:
- 12 teams to start development
- PIC to manage submissions
- Auto-deployment to GitHub Pages
- Discord notifications
- Progress tracking

---

<div align="center">

**Created with ❤️ for SMK Negeri 7 Samarinda**  
**XII PPLG 1 - Mini Web Project 2026**

🌴 Pariwisata Kalimantan Timur Berkelanjutan 🌴

</div>
