/**
 * Liangpran System Core
 * Handles localStorage database, authentication, and CRUD logic.
 */

const System = (function() {
    const DB_KEY = 'liangpran_db_v1';
    const SESSION_KEY = 'liangpran_session';

    // Mock MD5 for '123' -> '202cb962ac59075b964b07152d234b70'
    // Simple hash function for simulation purposes
    function simpleHash(str) {
        let hash = 0;
        for (let i = 0, len = str.length; i < len; i++) {
            let chr = str.charCodeAt(i);
            hash = (hash << 5) - hash + chr;
            hash |= 0; // Convert to 32bit integer
        }
        return Math.abs(hash).toString(16);
    }
    // Pre-calculated hash for '123' used in seed
    const HASH_123 = "123"; // Keeping it simple for this mock, normally we'd force MD5

    // Initial Dummy Data
    const seedData = {
        users: [
            { id: 1, username: 'admin', password: '123', name: 'Super Admin', role: 'admin' },
            { id: 2, username: 'editor', password: '123', name: 'Content Editor', role: 'editor' }
        ],
        categories: [
            { id: 1, name: 'Nature', slug: 'nature' },
            { id: 2, name: 'Culture', slug: 'culture' },
            { id: 3, name: 'Event', slug: 'event' }
        ],
        main_data: [
            // Nature
            { id: 1, title: 'Hutan Hujan Tropis', category_id: 1, desc: 'Paru-paru dunia yang masih terjaga.', image: './assets/nature-forest.png', type: 'image' },
            { id: 2, title: 'Flora Endemik', category_id: 1, desc: 'Rumah bagi ribuan spesies anggrek.', image: null, type: 'pattern' },
            { id: 3, title: 'Sungai Kehidupan', category_id: 1, desc: 'Aliran nadi Mahakam.', image: './assets/hero-mountain.png', type: 'river' },
            { id: 4, title: 'Puncak Liangpran', category_id: 1, desc: 'Negeri di atas awan.', image: './assets/hero-mountain.png', type: 'image' },
            { id: 5, title: 'Air Terjun Jantur', category_id: 1, desc: 'Kesegaran alami hutan borneo.', image: './assets/nature-forest.png', type: 'image' },
            // Culture
            { id: 6, title: 'Tari Hudoq', category_id: 2, desc: 'Tarian topeng pemanggil roh baik.', image: './assets/culture-community.png', type: 'image' },
            { id: 7, title: 'Rumah Lamin', category_id: 2, desc: 'Arsitektur panjang khas Dayak.', image: './assets/culture-community.png', type: 'image' },
            { id: 8, title: 'Tenun Ulap Doyo', category_id: 2, desc: 'Kain tenun dari serat daun doyo.', image: './assets/culture-community.png', type: 'image' },
            { id: 9, title: 'Upacara Adat', category_id: 2, desc: 'Ritual syukur panen raya.', image: './assets/culture-community.png', type: 'image' },
            { id: 10, title: 'Seni Manik', category_id: 2, desc: 'Kerajinan tangan penuh makna.', image: './assets/culture-community.png', type: 'image' }
        ]
    };

    // --- Database Core ---
    function loadDB() {
        const data = localStorage.getItem(DB_KEY);
        if (!data) {
            localStorage.setItem(DB_KEY, JSON.stringify(seedData));
            return seedData;
        }
        return JSON.parse(data);
    }

    function saveDB(data) {
        localStorage.setItem(DB_KEY, JSON.stringify(data));
    }

    // --- API Exposure ---
    return {
        key: 'SYSTEM_READY',
        
        // Database Operations
        db: {
            getAll: (table) => {
                const db = loadDB();
                return db[table] || [];
            },
            getById: (table, id) => {
                const db = loadDB();
                return db[table].find(item => item.id == id);
            },
            create: (table, item) => {
                const db = loadDB();
                if (!db[table]) return false;
                
                item.id = Date.now(); // Simple ID generation
                db[table].unshift(item); // Add to top
                saveDB(db);
                return item;
            },
            update: (table, id, updates) => {
                const db = loadDB();
                const index = db[table].findIndex(item => item.id == id);
                if (index === -1) return false;

                db[table][index] = { ...db[table][index], ...updates };
                saveDB(db);
                return db[table][index];
            },
            delete: (table, id) => {
                const db = loadDB();
                const initialLength = db[table].length;
                db[table] = db[table].filter(item => item.id != id);
                saveDB(db);
                return db[table].length < initialLength;
            },
            reset: () => {
                localStorage.removeItem(DB_KEY);
                location.reload();
            }
        },

        // Authentication Logic
        auth: {
            login: (username, password) => {
                const db = loadDB();
                // Simulation: In real world, password should be hashed before compare
                const user = db.users.find(u => u.username === username && u.password === password);
                if (user) {
                    const session = {
                        id: user.id,
                        name: user.name,
                        role: user.role,
                        token: 'mock_token_' + Date.now()
                    };
                    localStorage.setItem(SESSION_KEY, JSON.stringify(session));
                    return { success: true, user: session };
                }
                return { success: false, message: 'Invalid credentials' };
            },
            logout: () => {
                localStorage.removeItem(SESSION_KEY);
                window.location.href = 'admin.html'; // Redirect
            },
            getSession: () => {
                return JSON.parse(localStorage.getItem(SESSION_KEY));
            },
            requireAuth: () => {
                const session = JSON.parse(localStorage.getItem(SESSION_KEY));
                if (!session) {
                    // Start in login mode
                    return false; 
                }
                return true;
            }
        }
    };
})();
