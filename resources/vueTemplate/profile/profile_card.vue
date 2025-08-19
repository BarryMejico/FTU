<template>
    <div>
        <div class="user-card" data-name="Sarah Johnson" data-role="Frontend Developer" data-skills="React JavaScript TypeScript CSS">
                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150&h=150&fit=crop&crop=face" alt="Sarah Johnson" class="user-avatar">
                <h3 class="user-name">Sarah Johnson</h3>
                <p class="user-role">Frontend Developer</p>
                <div class="user-info">
                    <div class="info-item">
                        <span class="info-icon">📧</span>
                        <span>sarah.johnson@company.com</span>
                    </div>
                    <div class="info-item">
                        <span class="info-icon">📱</span>
                        <span>+1 (555) 123-4567</span>
                    </div>
                    <div class="info-item">
                        <span class="info-icon">📍</span>
                        <span>San Francisco, CA</span>
                    </div>
                </div>
                <div class="user-skills">
                    <div class="skills-title">Skills</div>
                    <div class="skills-list">
                        <span class="skill-tag">React</span>
                        <span class="skill-tag">JavaScript</span>
                        <span class="skill-tag">TypeScript</span>
                        <span class="skill-tag">CSS</span>
                    </div>
                </div>
            </div>
    </div>
</template>

<style>
.user-card {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.2);
            position: relative;
            overflow: hidden;
        }

        .user-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
        }

        .user-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            background: white;
        }
        .users-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .user-card {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.2);
            position: relative;
            overflow: hidden;
        }

        .user-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
        }

        .user-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            background: white;
        }

        .user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin: 0 auto 1rem;
            display: block;
            border: 3px solid #f0f0f0;
            transition: all 0.3s ease;
        }

        .user-card:hover .user-avatar {
            border-color: #667eea;
            transform: scale(1.05);
        }

        .user-name {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
            text-align: center;
            margin-bottom: 0.3rem;
        }

        .user-role {
            color: #667eea;
            text-align: center;
            font-weight: 500;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #666;
            font-size: 0.85rem;
        }

        .info-icon {
            width: 14px;
            color: #667eea;
        }

        .user-skills {
            margin-top: 1rem;
        }

        .skills-title {
            font-size: 0.85rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.35rem;
        }

        .skill-tag {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 0.2rem 0.6rem;
            border-radius: 16px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        </style>