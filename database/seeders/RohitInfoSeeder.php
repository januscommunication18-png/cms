<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ClientPassword;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RohitInfoSeeder extends Seeder
{
    public function run(): void
    {
        // Create CVS CRM Migration case study
        $contentBlocks = [
            'version' => 1,
            'blocks' => [
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'hero',
                    'order' => 0,
                    'collapsed' => false,
                    'data' => [
                        'image' => '',
                        'title' => 'Migrating from Oracle CRM to Salesforce CRM for Operational Efficiency',
                        'subtitle' => 'Oracle to Salesforce transformation for enhanced back-office operations',
                        'overlay_opacity' => 40
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 1,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Overview'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 2,
                    'collapsed' => false,
                    'data' => [
                        'content' => "This enterprise migration project focused on transitioning from Oracle CRM to Salesforce CRM for a major back-office transformation. The primary goal was to enhance efficiency and service delivery within CVS's internal operations—particularly within the call center environment. Key objectives included reducing average call times, streamlining user account management, and creating a consistent user journey across all CVS platforms.\n\nThe system overhaul also aimed to enable call center agents to handle complex tasks such as merging user profiles and converting proxy users with greater accuracy and speed—ultimately improving the customer experience and aligning with CVS's digital transformation roadmap."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'stats',
                    'order' => 3,
                    'collapsed' => false,
                    'data' => [
                        'stats' => [
                            ['label' => 'EC+ Members', 'value' => '26.2M+'],
                            ['label' => 'Weekly Holds', 'value' => '40-50K'],
                            ['label' => 'Proxy Users', 'value' => '40M+'],
                            ['label' => 'Self-Service Rate', 'value' => '<1%']
                        ]
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 4,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Challenges'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 5,
                    'collapsed' => false,
                    'data' => [
                        'content' => "The primary challenge was the high volume of EC+ accounts placed on hold each week, averaging 40,000–50,000 users, largely due to failed or outdated payment methods. Despite having over 26.2 million active EC+ members, less than 1% of members were able to resolve these issues through self-service, resulting in a major support burden and revenue loss.\n\nA deeper analysis using Adobe Target and analytics tools revealed several UX gaps:"
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'two_column',
                    'order' => 6,
                    'collapsed' => false,
                    'data' => [
                        'left_title' => 'Data & Process Issues',
                        'left_content' => "• **Disjointed User Data:** Existing user information was scattered across multiple systems (Pharmacy, Caremark, MinuteClinic), making profile merging difficult and error-prone\n\n• **Manual and Time-Consuming Processes:** Agents had to toggle between different platforms, leading to longer call durations and inconsistent service",
                        'right_title' => 'System Limitations',
                        'right_content' => "• **Proxy User Complexity:** Over 40 million users existed as proxy or partial profiles, many without full registration, complicating service interactions\n\n• **Tool Limitations in Oracle CRM:** The legacy system lacked flexibility for dynamic workflows, automated merging, or agent-assist features"
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 7,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Design Process'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 8,
                    'collapsed' => false,
                    'data' => [
                        'content' => "We began by conducting workflow audits across multiple CVS business lines to understand how call center agents interacted with the existing CRM. User journeys were mapped for key tasks such as user validation, profile conversion, and cross-platform account merging.\n\nLow-fidelity wireframes were developed to reimagine a streamlined interface within Salesforce, focusing on reducing cognitive load and improving process flow. High-fidelity prototypes were later created to simulate real interactions and integrated directly with Salesforce Lightning components.\n\nThe redesign introduced contextual search, guided merging steps, and role-based access to sensitive data—all tested and refined through direct feedback loops with call center agents and support teams."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 9,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Key Layout Elements'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 10,
                    'collapsed' => false,
                    'data' => [
                        'content' => 'Here are key layout elements for the Bell Call Center Application using the Salesforce Lightning Design Framework:'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'two_column',
                    'order' => 11,
                    'collapsed' => false,
                    'data' => [
                        'left_title' => 'Search & Navigation',
                        'left_content' => "• **Global Search Panel:** Positioned at the top with filters (Name, Email, Phone, etc.) and smart suggestions for quick user identification\n\n• **Search Result Cards:** Results displayed in a collapsible card layout with high-level user info, status alerts (e.g., verified, duplicate), and key action buttons\n\n• **User Verification Alerts:** Highlighted banners for incomplete profiles or verification needs, prompting immediate action\n\n• **Tab-Based Navigation:** Organized access to user profile, interaction history, orders, prescriptions, and call logs",
                        'right_title' => 'Actions & Workflows',
                        'right_content' => "• **Action Bar:** Persistent toolbar for critical actions like \"Merge Account,\" \"Create New Customer,\" \"Update Info,\" or \"Mark as Verified\"\n\n• **Expandable Details Panel:** Allows users to expand each search result inline to view full account details without navigating away\n\n• **Guided Workflow Sections:** Step-by-step flows for user validation, proxy-to-member conversion, and account merging\n\n• **Contextual Help Icons:** Tooltip support integrated throughout for training-light usage"
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'two_column',
                    'order' => 12,
                    'collapsed' => false,
                    'data' => [
                        'left_title' => 'Adaptive Interface',
                        'left_content' => '• **Role-Based UI Elements:** Components adapt dynamically depending on user role (agent, supervisor, admin)',
                        'right_title' => 'Responsive Design',
                        'right_content' => '• **Responsive Layout:** Optimized for both desktop and tablet devices with Salesforce Lightning grid system'
                    ]
                ]
            ]
        ];

        $project = Project::updateOrCreate(
            ['slug' => 'migrating-from-oracle-crm-to-salesforce-crm-for-operational-efficiency'],
            [
                'title' => 'Migrating from Oracle CRM to Salesforce CRM for Operational Efficiency',
                'description' => "A major enterprise migration project transitioning from Oracle CRM to Salesforce CRM, focused on enhancing call center efficiency and service delivery within CVS's internal operations.",
                'content_blocks' => $contentBlocks,
                'category_id' => 3, // Salesforce category
                'client_name' => 'CVS Health',
                'is_featured' => false,
                'order' => 11,
                'tags' => ['Salesforce', 'CRM', 'Enterprise', 'UX Design', 'Call Center']
            ]
        );

        // Attach CVS client password for protection
        $cvsPassword = ClientPassword::where('name', 'CVS')->first();
        if ($cvsPassword) {
            $project->clientPasswords()->syncWithoutDetaching([$cvsPassword->id]);
        }

        // Create EC+ Membership Journey case study
        $ecPlusContentBlocks = [
            'version' => 1,
            'blocks' => [
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'hero',
                    'order' => 0,
                    'collapsed' => false,
                    'data' => [
                        'image' => '',
                        'title' => 'From Hold to Renewal: Reimagining the EC+ Membership Journey',
                        'subtitle' => 'Streamlining membership renewal for 26 million CVS ExtraCare Plus members',
                        'overlay_opacity' => 40
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 1,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Business Scope'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 2,
                    'collapsed' => false,
                    'data' => [
                        'content' => "CVS Health's ExtraCare Plus (EC+) program serves over 26 million active members, offering valuable savings and benefits. However, each week, 40,000–50,000 accounts are placed on hold—primarily due to expired or declined payment methods. With an OKR target of 7.4 million enrolled members, reducing friction in the renewal process is a top business priority.\n\nThe core need was to streamline the membership renewal experience by enabling customers to self-service their payment issues. This included the ability to update credit card details, remove saved payment methods, or cancel membership—all through a simplified, unified interface.\n\nBy redesigning this experience and integrating CVS's new checkout component and design system, the business aimed to improve re-enrollment rates, reduce support center dependency, and increase customer satisfaction. This initiative also aligned with broader CVS digital strategy goals: enabling proactive, personalized, and seamless health commerce experiences across web and mobile."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'stats',
                    'order' => 3,
                    'collapsed' => false,
                    'data' => [
                        'stats' => [
                            ['label' => 'Active EC+ Members', 'value' => '26M+'],
                            ['label' => 'Weekly Holds', 'value' => '40-50K'],
                            ['label' => 'OKR Target', 'value' => '7.4M'],
                            ['label' => 'Self-Service Rate', 'value' => '<1%']
                        ]
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 4,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Challenges'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 5,
                    'collapsed' => false,
                    'data' => [
                        'content' => "The primary challenge was the high volume of EC+ accounts placed on hold each week, averaging 40,000–50,000 users, largely due to failed or outdated payment methods. Despite having over 26.2 million active EC+ members, less than 1% of members were able to resolve these issues through self-service, resulting in a major support burden and revenue loss.\n\nA deeper analysis using Adobe Target and analytics tools revealed several UX gaps:"
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'two_column',
                    'order' => 6,
                    'collapsed' => false,
                    'data' => [
                        'left_title' => 'User Experience Gaps',
                        'left_content' => "• Users received limited guidance or context on why their account was on hold\n\n• There was no easy way for users to update their card, remove a card, or cancel directly from the on-hold experience\n\n• The existing renewal flow was disjointed across email, SMS, and web touchpoints",
                        'right_title' => 'Technical & Business Challenges',
                        'right_content' => "• The payment components used were outdated and not aligned with CVS's new enterprise design system, creating inconsistency and usability issues\n\n• Multiple systems (marketing, payments, CRM) needed to support a unified renewal process\n\n• The OKR goal of enrolling 7.4 million EC+ members added urgency to improving conversion and retention"
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 7,
                    'collapsed' => false,
                    'data' => [
                        'content' => 'These challenges shaped the core direction of the project: simplify the experience, enable user control, and reduce dependency on manual intervention.'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 8,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Design Process'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 9,
                    'collapsed' => false,
                    'data' => [
                        'content' => "The design process began with a collaborative discovery phase involving product, analytics, and customer service teams. By analyzing behavioral data through Adobe Target and customer feedback, we uncovered critical friction points in the renewal journey—especially for users attempting to resolve account holds due to failed payments. These insights shaped our initial design direction: simplify the process, clarify messaging, and empower users with self-service tools.\n\nWe mapped out the end-to-end user journey across email, SMS, and web entry points. The existing flow was fragmented, with inconsistent UI elements and limited functionality to update or remove saved payment methods. Using this map, we identified key opportunities to streamline re-enrollment and reduce dependency on support channels.\n\nNext, we designed low-fidelity wireframes focusing on core tasks: updating payment information, canceling membership, and understanding account status. We tested early concepts with stakeholders and customer support leads to validate assumptions and ensure alignment with real user needs.\n\nFrom there, we moved into high-fidelity designs in Figma, aligning the new experience with CVS's updated design system and integrating a newly built checkout component. We also worked closely with engineering to ensure the technical feasibility of modular components—such as 'Add Card,' 'Remove Card,' and 'Cancel Membership.'\n\nThroughout the sprint cycles, we conducted iterative design reviews and QA walk-throughs, refining microinteractions, accessibility, and error handling based on real usage scenarios. The final experience was not just a UI upgrade—it was a behavioral shift. By reducing cognitive load, enabling card updates in fewer clicks, and giving users control over their membership, we created a flow that both met business goals and significantly improved the user experience."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 10,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Design Iterations'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 11,
                    'collapsed' => false,
                    'data' => [
                        'content' => 'We refined the design through multiple iterations based on stakeholder input and testing insights. Key changes included simplifying the card update flow and improving clarity around membership status and actions.'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 12,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Key Layout Elements'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 13,
                    'collapsed' => false,
                    'data' => [
                        'content' => 'The checkout journey was simplified by breaking down the payment update flow, focusing on the most common user action—updating expiration date and CVV. A new "Cancel Subscription" component was also introduced to give users more control within the same interface.'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'two_column',
                    'order' => 14,
                    'collapsed' => false,
                    'data' => [
                        'left_title' => 'Checkout & Payment',
                        'left_content' => "• **Simplified Checkout Flow:** Broke down the checkout component to streamline the renewal process and reduce cognitive load\n\n• **Focused Payment Update UI:** Optimized the layout for the most common task—updating expiration date and CVV—based on payment gateway data (used by 80% of users)\n\n• **Integrated Cancel Option:** Introduced a clear 'Cancel Subscription' component directly within the renewal flow to give users better control",
                        'right_title' => 'Design System',
                        'right_content' => "• **Modular Component Design:** Designed components to be reusable across other CVS services while staying consistent with the new design system\n\n• **Improved Visual Hierarchy:** Prioritized key actions (e.g., update card, cancel membership) to reduce confusion and improve task completion"
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 15,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Cancellation Journey'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 16,
                    'collapsed' => false,
                    'data' => [
                        'content' => 'The new layout emphasizes transparency, ease of action, and graceful exit—while still promoting value recall and opportunities for feedback and reactivation.'
                    ]
                ]
            ]
        ];

        $ecPlusProject = Project::updateOrCreate(
            ['slug' => 'from-hold-to-renewal-reimagining-the-ec-membership-journey'],
            [
                'title' => 'From Hold to Renewal: Reimagining the EC+ Membership Journey',
                'description' => "Streamlining CVS ExtraCare Plus membership renewal experience by enabling self-service payment updates, reducing support dependency, and improving re-enrollment rates for 26 million active members.",
                'content_blocks' => $ecPlusContentBlocks,
                'category_id' => 1, // Health Care category
                'client_name' => 'CVS Health',
                'is_featured' => false,
                'order' => 12,
                'tags' => ['Design System', 'Health Care', 'Membership', 'Retail', 'E-commerce', 'Checkout', '2024']
            ]
        );

        // Attach CVS client password for protection
        if ($cvsPassword) {
            $ecPlusProject->clientPasswords()->syncWithoutDetaching([$cvsPassword->id]);
        }

        // Create Health Reporting Platform case study
        $healthReportingBlocks = [
            'version' => 1,
            'blocks' => [
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'hero',
                    'order' => 0,
                    'collapsed' => false,
                    'data' => [
                        'image' => '',
                        'title' => 'Health Reporting Platform: From Data Silos to a Seamless Dashboard',
                        'subtitle' => 'Unifying disparate reporting tools into a single intuitive interface for CVS Health',
                        'overlay_opacity' => 40
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 1,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Overview'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 2,
                    'collapsed' => false,
                    'data' => [
                        'content' => "CVS Health's Pharmacy Benefit Management (PBM) and analytics teams relied on scattered reporting tools and data platforms—ranging from Salesforce to Snowflake and in-house data warehouses. This led to inefficient workflows, inconsistent report views, and limited self-service capabilities.\n\nThe Big Data Reporting initiative focused on consolidating disparate reporting tools into a unified platform for the Pharmacy Benefit Management (PBM) team. The goal was to deliver a single, intuitive interface that allows business and clinical teams to access complex medication performance data across multiple sources—Salesforce, Snowflake, internal data warehouses, and more.\n\nOur team was tasked with building a flexible, scalable reporting dashboard that could support deep insights while remaining accessible for non-technical users. The project involved designing the interface, creating a new report widget system, and aligning the UI with CVS's enterprise design system."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 3,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Business Requirements'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'two_column',
                    'order' => 4,
                    'collapsed' => false,
                    'data' => [
                        'left_title' => 'Data & Integration',
                        'left_content' => "• **Unify Disparate Data Sources** - Consolidate data from Snowflake, Salesforce, Big Data pipelines, and internal warehouses into one dashboard interface\n\n• **Support System Integrations** - Ensure compatibility with diverse data pipelines and support real-time updates from various back-end technologies\n\n• **Enable Customizable Report Viewing** - Allow users from pharmacy operations, clinical teams, and analytics groups to build personalized dashboards with relevant widgets",
                        'right_title' => 'Security & Design',
                        'right_content' => "• **Ensure Security and Role-Based Access** - Implement permission-based access to ensure compliance with HIPAA and CVS internal data privacy protocols\n\n• **Match CVS's Enterprise Design System** - Build new UI patterns, such as the report widget builder, while maintaining brand and design consistency"
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 5,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Key Challenges (UX/UI Perspective)'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 6,
                    'collapsed' => false,
                    'data' => [
                        'content' => "Analytics teams relied on scattered reporting tools and data platforms—ranging from Salesforce to Snowflake and in-house data warehouses. This led to inefficient workflows, inconsistent report views, and limited self-service capabilities.\n\n• Designing for a wide range of users with different technical skill levels and reporting needs\n• Translating legacy, multi-platform workflows into intuitive modern interfaces\n• Creating a modular widget system without disrupting data integrity or visual consistency\n• Handling dense, complex data while maintaining accessibility and ease of use\n• Working within strict design governance while introducing net-new UX interactions"
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 7,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Collaboration with Technology Team'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 8,
                    'collapsed' => false,
                    'data' => [
                        'content' => "Key findings from our collaboration:\n\n• Teams were switching between 3–5 reporting tools daily for a single decision\n• Reports lacked a standardized structure or naming convention, leading to duplication and inconsistency\n• Business teams requested a \"one-stop\" reporting space with quick filters and saved views\n• Automation teams emphasized the need for report configuration reusability and auto-refresh logic"
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 9,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Design Process'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 10,
                    'collapsed' => false,
                    'data' => [
                        'content' => "The design process for the Health Reporting Dashboard required a structured yet adaptive approach to solve both technical and user experience challenges across teams. Our goal was to create a unified, flexible, and scalable reporting platform while aligning with CVS's enterprise design system."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'two_column',
                    'order' => 11,
                    'collapsed' => false,
                    'data' => [
                        'left_title' => '1. Discovery & Alignment',
                        'left_content' => "We began by interviewing Pharmacy Benefit Managers, Clinical Analysts, and Automation Engineers to understand how reports were accessed and used. A review of tools like Salesforce, Snowflake, and spreadsheets revealed fragmented workflows and key usability gaps. This helped us define clear priorities: centralized access, customizable views, strong security, and a seamless user experience across roles.",
                        'right_title' => '2. Information Architecture',
                        'right_content' => "To support a flexible and scalable reporting experience, we defined a modular framework for organizing dashboard sections and report widgets. This structure allowed users to personalize their views without overwhelming the interface. We also developed a metadata tagging system to classify reports by source, team, and type—making search and filtering more intuitive."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'two_column',
                    'order' => 12,
                    'collapsed' => false,
                    'data' => [
                        'left_title' => '3. Low-Fidelity Wireframes',
                        'left_content' => "We sketched key user flows for discovering reports, managing widgets, and customizing dashboard views. Early concepts were validated with analysts and business users to ensure alignment with real-world tasks. The focus was on simplifying the layout while retaining enough flexibility for power users.",
                        'right_title' => '4. High-Fidelity Designs & Prototyping',
                        'right_content' => "We created detailed mockups in Figma, aligning with CVS's design system while extending it to support custom report widgets, inline filters, and visual source tags like Snowflake and Big Data. Interactive prototypes were built to test key interactions, including filter behavior, widget layout, and drill-down navigation."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'two_column',
                    'order' => 13,
                    'collapsed' => false,
                    'data' => [
                        'left_title' => '5. Usability Testing & Iteration',
                        'left_content' => "We conducted usability testing with 10 internal users from clinical, operations, and analytics teams. Feedback highlighted the need for more flexible widget layout controls, clearer source indicators, and more intuitive filter behavior. In response, we introduced drag-and-drop functionality, added \"Save Filter Set\" and \"Clear All\" options, and improved guidance through contextual help and tooltips.",
                        'right_title' => '6. Design Handoff & Support',
                        'right_content' => "We collaborated closely with engineering to deliver annotated components and design tokens, ensuring smooth integration. Responsive layout specs and detailed component states supported accurate implementation. To maintain consistency, we created a mini UI kit for future widget development and assisted QA with accessibility reviews and design validation."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 14,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Research Findings'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 15,
                    'collapsed' => false,
                    'data' => [
                        'content' => "Key findings from Business & Automation Teams:\n\n• Teams were switching between 3–5 reporting tools daily for a single decision\n• Reports lacked a standardized structure or naming convention, leading to duplication and inconsistency\n• Business teams requested a \"one-stop\" reporting space with quick filters and saved views\n• No clear understanding of app value — users completed onboarding without knowing what to do next or why the app mattered\n• Limited personalization — one-size-fits-all onboarding failed to adapt to different user goals or familiarity with private social platforms"
                    ]
                ]
            ]
        ];

        $healthReportingProject = Project::updateOrCreate(
            ['slug' => 'health-reporting-platform-from-data-silos-to-seamless-dashboard'],
            [
                'title' => 'Health Reporting Platform: From Data Silos to a Seamless Dashboard',
                'description' => "Consolidating disparate reporting tools into a unified platform for CVS Health's Pharmacy Benefit Management team, delivering a single intuitive interface for complex medication performance data.",
                'content_blocks' => $healthReportingBlocks,
                'category_id' => 1, // Health Care category
                'client_name' => 'CVS Health',
                'is_featured' => false,
                'order' => 13,
                'tags' => ['Data Visualization', 'Health Care', 'Salesforce', 'Reporting', 'Design System', '2023']
            ]
        );

        // Attach CVS client password for protection
        if ($cvsPassword) {
            $healthReportingProject->clientPasswords()->syncWithoutDetaching([$cvsPassword->id]);
        }

        // Create Loyalty Membership Management case study
        $loyaltyBlocks = [
            'version' => 1,
            'blocks' => [
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'hero',
                    'order' => 0,
                    'collapsed' => false,
                    'data' => [
                        'image' => '',
                        'title' => 'Simplifying Loyalty Membership Management',
                        'subtitle' => 'Centralizing ExtraCare and ExtraCare Plus benefits into a unified customer experience',
                        'overlay_opacity' => 40
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 1,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Overview'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 2,
                    'collapsed' => false,
                    'data' => [
                        'content' => "The CVS Loyalty Membership redesign project aimed to centralize and simplify the customer experience for managing ExtraCare and ExtraCare Plus benefits. A new single-screen hub with intuitive flows was developed to help members understand, access, and use their benefits more effectively—ultimately increasing engagement and reducing churn."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 3,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Business Scope'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 4,
                    'collapsed' => false,
                    'data' => [
                        'content' => "The new loyalty experience was built to solve a key customer need: a unified location to manage everything related to loyalty membership. The new experience supports updates to payment, benefit access, and membership upgrades, all while aligning with CVS's broader digital design system. This functionality is targeted at active ExtraCare and CarePass users who may not currently realize the full value of their membership."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 5,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Challenges'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 6,
                    'collapsed' => false,
                    'data' => [
                        'content' => "• No centralized location for members to manage or update their ExtraCare or ExtraCare Plus memberships\n• Low awareness of available benefits, such as pharmacist calls or free shipping\n• Customers often canceled due to perceived lack of value in the program\n• Outdated user interface with unclear call-to-actions and overloaded screens\n• Disconnected flows across web and mobile, leading to poor task completion rates"
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 7,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Design Process'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 8,
                    'collapsed' => false,
                    'data' => [
                        'content' => "The redesign process followed a human-centered approach:"
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'two_column',
                    'order' => 9,
                    'collapsed' => false,
                    'data' => [
                        'left_title' => '1. User Interviews & Task Observations',
                        'left_content' => "We conducted 6 qualitative research sessions with long-term CarePass and ExtraCare users. These interviews helped us understand real-world frustrations and unmet needs around benefit usage, membership management, and upgrade decisions.",
                        'right_title' => '2. Task Analysis',
                        'right_content' => "Mapped the end-to-end journey for membership management: payment updates, cancelation, benefit review, and pharmacist calls. Pain points were prioritized based on frequency and impact."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'two_column',
                    'order' => 10,
                    'collapsed' => false,
                    'data' => [
                        'left_title' => '3. Wireframes & Prototyping',
                        'left_content' => "Developed low and high-fidelity mockups focused on a single-page hub layout. Calls-to-action were made more prominent, benefits were contextualized with descriptions, and settings were grouped intuitively.",
                        'right_title' => '4. Usability Testing',
                        'right_content' => "Participants successfully completed key tasks in prototype testing, such as locating benefits and managing membership settings. CTA recognition increased by 40% and task completion rate improved across all participants."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 11,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Research Findings'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 12,
                    'collapsed' => false,
                    'data' => [
                        'content' => "• Users were unaware of many benefits already available in their membership\n• Customers appreciated the ability to compare ExtraCare vs ExtraCare Plus benefits side-by-side\n• Clear visual hierarchy reduced cognitive load and improved confidence in navigating the screen\n• Some members expected to find pharmacist call or health line benefits listed more prominently\n• Users were more likely to engage with benefits when they saw \"Next Best Actions\" (e.g., Schedule a Health Call, Refill an RX)"
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 13,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Competitive Landscape'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 14,
                    'collapsed' => false,
                    'data' => [
                        'content' => "To position CVS's loyalty redesign effectively, we conducted a market study of major retail competitors—Target (Circle), Walmart (Walmart+), and Amazon (Prime). Each offers a membership program that bundles convenience, savings, and healthcare-related perks."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'two_column',
                    'order' => 15,
                    'collapsed' => false,
                    'data' => [
                        'left_title' => 'Target Circle',
                        'left_content' => "• Offers rewards on purchases, personalized deals, and birthday gifts\n• No paid tier—free to join, but less benefit depth\n• No centralized dashboard; benefits are scattered across app sections\n• Healthcare integration is minimal\n\n✅ **Key takeaway:** Target excels at personalized promotions but lacks a unified membership experience.",
                        'right_title' => 'Walmart+',
                        'right_content' => "• \$98/year subscription with free delivery, fuel discounts, and early access to deals\n• Recently added access to virtual care via Walmart Health\n• Users can manage their subscription from a consolidated account hub\n\n✅ **Key takeaway:** Walmart+ emphasizes utility and health convenience but struggles with visual clarity."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 16,
                    'collapsed' => false,
                    'data' => [
                        'content' => "**Amazon Prime**\n\n• \$139/year membership with unmatched convenience: free shipping, streaming, pharmacy savings, and RxPass for \$5/month\n• Benefits are discoverable but buried; personalization is minimal\n• No intuitive \"membership management\" hub\n\n✅ **Key takeaway:** Amazon bundles tremendous value, but user control and benefit visibility remain fragmented."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 17,
                    'collapsed' => false,
                    'data' => [
                        'title' => 'Ideation'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 18,
                    'collapsed' => false,
                    'data' => [
                        'content' => "To create a more intuitive and actionable loyalty management experience, we began with a goal: simplify the interface while driving value recognition. We mapped the current fragmented flows and reimagined them as a single unified hub.\n\nOur ideation was driven by the insight that members didn't fully understand or use their benefits—not because they didn't exist, but because they weren't visible or contextual.\n\nWe brainstormed with cross-functional teams to define the core actions users needed:\n\n• View and compare ExtraCare vs. ExtraCare Plus benefits\n• Update payment methods quickly\n• Cancel or upgrade membership easily\n• Access high-value benefits like RX Line and free shipping at the right time"
                    ]
                ]
            ]
        ];

        $loyaltyProject = Project::updateOrCreate(
            ['slug' => 'simplifying-loyalty-membership-management'],
            [
                'title' => 'Simplifying Loyalty Membership Management',
                'description' => "Centralizing and simplifying the customer experience for managing CVS ExtraCare and ExtraCare Plus benefits through a new single-screen hub with intuitive flows.",
                'content_blocks' => $loyaltyBlocks,
                'category_id' => 1, // Health Care category
                'client_name' => 'CVS Health',
                'is_featured' => false,
                'order' => 14,
                'tags' => ['Loyalty', 'Membership', 'Retail', 'Design System', 'Health Care', 'E-commerce', '2024']
            ]
        );

        // Attach CVS client password for protection
        if ($cvsPassword) {
            $loyaltyProject->clientPasswords()->syncWithoutDetaching([$cvsPassword->id]);
        }

        // Create Redesigning Registration & Onboarding Experience case study
        $onboardingBlocks = [
            'version' => 1,
            'blocks' => [
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 0,
                    'collapsed' => false,
                    'data' => [
                        'content' => "<h2><strong class=\"ql-font-inter\">Overview</strong></h2><p><span class=\"ql-font-inter\">Myseum is a private social media app designed to help users preserve personal memories, connect with loved ones, and build a meaningful digital legacy. Unlike traditional social platforms, Myseum focuses on intentional, emotionally resonant sharing—allowing users to document life milestones, family stories, and personal reflections in a secure and distraction-free environment. The app enables users to:</span></p><ul><li><span class=\"ql-font-inter\">Create a timeline of personal moments</span></li><li><span class=\"ql-font-inter\">Share updates privately with close friends and family</span></li><li><span class=\"ql-font-inter\">Collaborate on memory collections</span></li><li><span class=\"ql-font-inter\">Share updates privately with close friends and family</span></li><li><span class=\"ql-font-inter\">Maintain control over who sees what</span></li></ul><p><br></p>"
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 1,
                    'collapsed' => false,
                    'data' => [
                        'content' => "<h2><strong class=\"ql-font-inter\">The Challenge</strong></h2><p><span class=\"ql-font-inter\">The original onboarding experience was outdated, overly linear, and lacked clear guidance. Users often dropped off before completing registration or found it confusing to set up key elements like profile info and location. Additionally, the UI did not align with the emotional tone of the app, which is centered around meaningful memories and personal storytelling. Key issues with the old design (see reference image):</span></p><ul><li><span class=\"ql-font-inter\">Lack of visual feedback during steps</span></li><li><span class=\"ql-font-inter\">Poor hierarchy and guidance</span></li><li><span class=\"ql-font-inter\">No personality or emotional tone in the UI</span></li><li><span class=\"ql-font-inter\">Unclear progress tracking</span></li><li><span class=\"ql-font-inter\">Low engagement on final onboarding screens</span></li></ul><p><br></p>"
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 2,
                    'collapsed' => false,
                    'data' => [
                        'content' => "<h2><strong class=\"ql-font-inter\">Design Process</strong></h2><p><span class=\"ql-font-inter\">We followed a structured design process to identify pain points, prototype solutions, and validate improvements:</span></p>"
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'two_column',
                    'order' => 3,
                    'collapsed' => false,
                    'data' => [
                        'left_title' => '1. Research & Analysis',
                        'left_content' => "<p><span style=\"background-color: rgb(254, 246, 245); font-size: 16px; color: rgb(33, 37, 41);\" class=\"ql-font-inter\">Reviewed analytics, user feedback, and industry benchmarks to understand drop-off points and UX gaps in the old flow.</span></p>",
                        'right_title' => '2. User Journey Mapping',
                        'right_content' => "<h4><strong class=\"ql-font-inter\">User Journey Mapping</strong></h4><p><span style=\"background-color: rgb(254, 246, 245); font-size: 16px; color: rgb(33, 37, 41);\" class=\"ql-font-inter\">Created a revised flow with key milestones: phone verification, password setup, profile creation, location tagging, and introductory walkthroughs.</span></p>"
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'two_column',
                    'order' => 4,
                    'collapsed' => false,
                    'data' => [
                        'left_title' => '3. Wireframes & Prototyping',
                        'left_content' => "Developed low and high-fidelity mockups focused on a single-page hub layout. Calls-to-action were made more prominent, benefits were contextualized with descriptions, and settings were grouped intuitively.",
                        'right_title' => '4. Usability Testing',
                        'right_content' => "Participants successfully completed key tasks in prototype testing, such as locating benefits and managing membership settings. CTA recognition increased by 40% and task completion rate improved across all participants."
                    ]
                ]
            ]
        ];

        $onboardingProject = Project::updateOrCreate(
            ['slug' => 'redesigning-the-registration-onboarding-experience-for-a-private-social-app'],
            [
                'title' => 'Redesigning the Registration & Onboarding Experience for a Private Social App',
                'description' => "This case study explores the redesign of the registration and onboarding flow for a private social media app focused on memory sharing and personal connections. Our goal was to improve the first-time user experience by reducing friction, guiding users seamlessly through setup, and establishing trust and clarity from the first tap.",
                'content_blocks' => $onboardingBlocks,
                'category_id' => 1, // Health Care category
                'client_name' => 'CVS Health',
                'is_featured' => false,
                'order' => 14,
                'tags' => ['MobileApp', 'B2C', 'Social Media', 'Native Mobile App', 'Development Phase', 'Consulting', '2025']
            ]
        );

        // This project is public (no client password protection)

        // Create Intuitive IVR Automation Interface case study
        $ivrBlocks = [
            'version' => 1,
            'blocks' => [
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'hero',
                    'order' => 0,
                    'collapsed' => false,
                    'data' => [
                        'image' => '',
                        'title' => 'Intuitive IVR Automation Interface for Patient Engagement',
                        'subtitle' => 'Modernizing legacy IVR systems with a no-code configuration platform for healthcare',
                        'overlay_opacity' => 40
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 1,
                    'collapsed' => false,
                    'data' => ['title' => 'Business Scope']
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 2,
                    'collapsed' => false,
                    'data' => [
                        'content' => 'The project aimed to modernize a legacy IVR system by leveraging Salesforce as the base framework, enabling hospital admins to independently configure and manage call flows without developer support. It also focused on improving patient engagement by simplifying voice interactions and streamlining post-discharge communication.'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'two_column',
                    'order' => 3,
                    'collapsed' => false,
                    'data' => [
                        'left_title' => 'Product Modernization',
                        'left_content' => "Redesign the existing IVR interface to replace the outdated, developer-dependent experience with a modern, no-code configuration platform that empowers hospital staff to build and manage IVR workflows independently.",
                        'right_title' => 'Improved Administrative Efficiency',
                        'right_content' => "Enable front desk and administrative users—non-technical by nature—to create, modify, and deploy IVR flows without involving IT, thereby reducing operational costs and turnaround time."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'two_column',
                    'order' => 4,
                    'collapsed' => false,
                    'data' => [
                        'left_title' => 'Enhanced Patient Engagement',
                        'left_content' => "Simplify the patient experience by reducing menu complexity and improving call routing logic to ensure faster access to the right information or support—especially during post-discharge scenarios.",
                        'right_title' => 'Operational Scalability',
                        'right_content' => "Create a scalable platform that can handle multi-location deployments, accommodate different hospital workflows, and reduce the reliance on the client support team for ongoing configuration and maintenance."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 5,
                    'collapsed' => false,
                    'data' => [
                        'content' => '**Strategic Differentiation** - Position the IVR solution as a self-service automation platform in the competitive healthcare market, delivering value not just through technical capability, but through ease of use, rapid deployment, and improved patient outcomes.'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 6,
                    'collapsed' => false,
                    'data' => ['title' => 'Challenges']
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 7,
                    'collapsed' => false,
                    'data' => [
                        'content' => 'The existing IVR interface created a high barrier to entry for non-technical users. Even minor updates required IT intervention, increasing cost and turnaround time. Admins struggled with navigating a cluttered, outdated interface filled with unnecessary options and unclear labels.'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 8,
                    'collapsed' => false,
                    'data' => [
                        'content' => "• **Resource-Intensive Deployment:** Basic tasks required training and technical support due to poor UI architecture\n\n• **Patient Friction:** Complex, non-intuitive IVR menus frustrated patients and caused communication breakdowns\n\n• **High Support Load:** Increased configuration-related errors drove up support requests and strained internal resources"
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 9,
                    'collapsed' => false,
                    'data' => ['title' => 'Design Process']
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 10,
                    'collapsed' => false,
                    'data' => [
                        'content' => "Getting a bird's eye view of the product. We started by conducting user interviews with hospital admins, patients, and caregivers from broad levels of expertise, from beginners and intermediate to experts to collect information."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'two_column',
                    'order' => 11,
                    'collapsed' => false,
                    'data' => [
                        'left_title' => '1. User Interviews',
                        'left_content' => "We conducted in-depth interviews with hospital front desk administrators to understand their pain points and existing workflows when setting up the IVR for a particular workflow to identify their frustrations with the current interface and explore their needs and expectations for an ideal solution.",
                        'right_title' => '2. Task Analysis',
                        'right_content' => "We observed administrators performing common tasks such as creating IVR menus, making changes to existing options, and troubleshooting issues. This helped identify specific areas for improvement and opportunities to streamline processes."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 12,
                    'collapsed' => false,
                    'data' => [
                        'content' => "**3. Affinity Mapping**\n\nWe extracted data points from user interviews, task analysis observations, and usability testing results. Key data points such as quotes, behaviors, and pain points were then classified into themes. The final groupings were analyzed to identify key insights about user frustrations, desired functionalities, and workflow preferences, which would inform the design direction."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 13,
                    'collapsed' => false,
                    'data' => ['title' => 'Research Findings']
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 14,
                    'collapsed' => false,
                    'data' => [
                        'content' => "**Patient quote:** \"This IVR system is a maze! I just wanted to schedule a follow-up appointment, but I keep getting looped back to the main menu. By the time I get a person, I'll be too frustrated to even explain why I called.\"\n\n**Admin quote:** \"We keep wanting to test different IVR greetings and workflows or even add new departments or services to improve patient experience, but making tweaks is a slow process.\""
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 15,
                    'collapsed' => false,
                    'data' => [
                        'content' => "• The dated and obscure UI of the existing system had no classification for frequent and advanced actions\n\n• Configuring a simple automation workflow took a lot of work, especially for inexperienced users\n\n• The system lacked guidance to help users make sense of the multiple options available"
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 16,
                    'collapsed' => false,
                    'data' => ['title' => 'UX Strategy']
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 17,
                    'collapsed' => false,
                    'data' => [
                        'content' => "IVR automation systems, while generally similar across industries, have some key differences when deployed in healthcare settings.\n\nWe therefore had to design a system that anticipates and gracefully handles user errors and ensures human intervention at the right time considering the fragile state of mind that the patients (disturbed/aged/anxious) and admins (distracted, busy) user groups may be in. It was critical to design a system that would provide clear and actionable feedback to users when issues arise, guiding them toward a solution that wouldn't require developer intervention."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 18,
                    'collapsed' => false,
                    'data' => ['title' => 'Ideation']
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 19,
                    'collapsed' => false,
                    'data' => [
                        'content' => "Our solution was focused on building a UI that would guide the users to take the right action intuitively, rather than having them explore and wonder what they must do. It would display only the essential options required to deploy the IVR workflow which makes it easy to operate with minimal training & instruction.\n\nWe had to ensure that the color palette was soothing and did not hamper the focus of the users. All buttons and pills would have to be labeled to be self-explanatory, removing all traces of speculation and wrong, unintended clicks."
                    ]
                ]
            ]
        ];

        Project::updateOrCreate(
            ['slug' => 'intuitive-ivr-automation-interface-for-patient-engagement'],
            [
                'title' => 'Intuitive IVR Automation Interface for Patient Engagement',
                'description' => "Modernizing a legacy IVR system by leveraging Salesforce as the base framework, enabling hospital admins to independently configure and manage call flows without developer support while improving patient engagement.",
                'content_blocks' => $ivrBlocks,
                'category_id' => 1, // Health Care category
                'client_name' => 'CVS Health',
                'is_featured' => false,
                'order' => 15,
                'tags' => ['Health Care', 'Salesforce', 'Workflow', 'Enterprise', 'Funnel Builder', 'IVR', '2024']
            ]
        );

        // This project is public (no client password protection)

        // Create Provider Resource Center (PRC) Redesign case study
        $prcBlocks = [
            'version' => 1,
            'blocks' => [
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'hero',
                    'order' => 0,
                    'collapsed' => false,
                    'data' => [
                        'image' => '',
                        'title' => 'Provider Resource Center (PRC) Redesign',
                        'subtitle' => 'Redesigning the digital front door to the leading provider network',
                        'overlay_opacity' => 40
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 1,
                    'collapsed' => false,
                    'data' => [
                        'content' => 'The Provider Resource Center (PRC) serves as the digital front door to Leading provider network. It is a vital touchpoint in the clinician experience, providing access to essential information, tools, and policies. PRC plays a critical role in enabling healthcare providers to stay informed, self-serve efficiently, and participate in key programs that support patient care.'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 2,
                    'collapsed' => false,
                    'data' => ['title' => 'Overview']
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 3,
                    'collapsed' => false,
                    'data' => [
                        'content' => "The Provider Portal is a centralized digital platform that serves as a critical interface between Highmark and its provider network. It offers access to essential resources, including policy updates, credentialing information, claim status, reimbursement guidelines, and program participation tools. Designed to support both clinical and administrative workflows, the portal enables providers to self-serve, stay informed, and engage with Highmark more efficiently—ultimately enhancing care delivery and operational effectiveness."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 4,
                    'collapsed' => false,
                    'data' => ['title' => 'Design Process']
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 5,
                    'collapsed' => false,
                    'data' => [
                        'content' => "I focused on creating an intuitive, accessible experience that simplifies the Provider Portal—making it easier for users to explore, locate resources, and access essential forms and manuals. Here's a breakdown of the process:"
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'two_column',
                    'order' => 6,
                    'collapsed' => false,
                    'data' => [
                        'left_title' => '1. Research & Ideation',
                        'left_content' => "To begin, we analyzed the needs and behaviors of provider users, many of whom found the existing site overly complex and overwhelming. The volume of content made it hard to identify what was relevant. These insights shaped early concepts, leading us to explore guided experiences and simplified content pathways.",
                        'right_title' => '2. Flow Mapping',
                        'right_content' => "I mapped user journeys step-by-step to ensure the experience felt logical, smooth, and focused. The goal was to reduce friction and cognitive load. A contextual chat assistant was introduced to act as a digital guide, offering support where needed. Analytics helped identify the most visited sections and prioritize them in the navigation structure."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'two_column',
                    'order' => 7,
                    'collapsed' => false,
                    'data' => [
                        'left_title' => '3. Wire-framing',
                        'left_content' => "Mid-fidelity wireframes were developed to visualize key flows, layouts, and page structures. This allowed for early usability testing, where we gathered feedback on task clarity and interaction points. One insight was the need for users to edit their selections post-result, which was incorporated into the flow. We also leveraged standard page layouts from Highmark's existing AEM design system to align with platform constraints.",
                        'right_title' => '4. Concept Design',
                        'right_content' => "With the experience mapped, I explored visual styles that aligned with Highmark's updated design language—clean, modern, and calm. The goal was to create an interface that felt welcoming and trustworthy, while working within the limitations and capabilities of AEM's component library."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'two_column',
                    'order' => 8,
                    'collapsed' => false,
                    'data' => [
                        'left_title' => '5. Final Design',
                        'left_content' => "The final design emphasized intuitive navigation, clearly defined interactions, and thoughtful layout. Subtle AI enhancements were introduced to assist without overwhelming the user. Attention was paid to hierarchy, responsiveness, and accessibility to support a wide range of user needs.",
                        'right_title' => '6. Implementation & Iteration',
                        'right_content' => "Throughout the development sprints, I conducted hands-on functional testing to identify UX gaps and inconsistencies. Rapid feedback loops allowed us to iterate and refine before release, ensuring a high-quality, user-friendly launch."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 9,
                    'collapsed' => false,
                    'data' => ['title' => 'Research']
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 10,
                    'collapsed' => false,
                    'data' => [
                        'content' => "**Who We Engaged:** To build a deeper understanding of the current Provider Resource Center (PRC) experience, we conducted a series of interviews, workshops, and reviews with key stakeholders and user representatives:\n\n• **Internal Stakeholders** – Including leaders from operations, product, and IT\n• **Provider Advisory Leaders (PALs)** – Group sessions with 22 PALs, representing diverse provider perspectives\n• **Operations Teams** – Including Reporting, Credentialing, Provider Information Management, and Utilization Management\n• **Module Deep Dives** – Focused sessions to understand specific functional areas and workflows\n• **Heuristic Reviews** – Expert UX evaluations of current PRC usability and content structure\n• **Usage Data Analysis** – Review of analytics to uncover behavioral patterns and engagement gaps"
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 11,
                    'collapsed' => false,
                    'data' => ['title' => 'What We Learned']
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 12,
                    'collapsed' => false,
                    'data' => [
                        'content' => 'Key themes that emerged from our research:'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'two_column',
                    'order' => 13,
                    'collapsed' => false,
                    'data' => [
                        'left_title' => 'Primary Pain Points',
                        'left_content' => "• **Payment Transparency:** Providers primarily access PRC to determine if and how they will be reimbursed\n• **Credentialing Clarity:** Understanding credentialing status and process is a major need\n• **Information Overload:** Users feel overwhelmed by excessive and poorly organized content\n• **Poor Information Accessibility:** Providers struggle to locate important information quickly—often resulting in confusion, errors, or missed updates",
                        'right_title' => 'Trust & Navigation Issues',
                        'right_content' => "• **Lack of Trust in Content:** Providers expressed uncertainty about the accuracy and reliability of the information presented\n• **Navigation Confusion:** Many struggled to understand the site's structure and how to access specific resources\n• **Low Awareness:** A significant number of providers were not aware of the PRC or its purpose\n• **Denial Troubleshooting:** Difficulty in resolving claim denials due to lack of clear guidance and resources"
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 14,
                    'collapsed' => false,
                    'data' => [
                        'content' => '• **Findability Issues:** Core content is often buried or hard to access, leading to inefficiencies and frustration'
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 15,
                    'collapsed' => false,
                    'data' => ['title' => 'Design Structure Framework']
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'text',
                    'order' => 16,
                    'collapsed' => false,
                    'data' => [
                        'content' => "Leveraging the newly established design system, we developed a flexible and reusable set of design patterns that ensure consistency across all PRC modules. The framework emphasizes accessibility, clarity, and ease of navigation—supporting multi-level page structures and contextual inline links to help providers quickly find what they need."
                    ]
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'section_heading',
                    'order' => 17,
                    'collapsed' => false,
                    'data' => ['title' => 'Key Layout Elements']
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'type' => 'two_column',
                    'order' => 18,
                    'collapsed' => false,
                    'data' => [
                        'left_title' => 'Page Structure',
                        'left_content' => "• **Modular Page Templates** – Reusable templates for policy pages, resource hubs, and program overviews\n• **Sticky Subnavigation** – Always-visible secondary navigation for easier access to key sections on long pages\n• **Inline Resource Links** – Embedded links within content blocks for quick access to related forms, manuals, and tools\n• **Expandable Accordions** – For organizing dense content like FAQs, guidelines, and policy details without overwhelming the user",
                        'right_title' => 'Navigation & Access',
                        'right_content' => "• **Multi-Level Page Hierarchy** – Clear breadcrumb trails and structured paths to support deep navigation\n• **Quick Access Panels** – Context-aware toolbars or banners highlighting high-priority actions or resources\n• **Role-Based Content Sections** – Region- and role-specific visibility rules to show only what's relevant\n• **Searchable Resource Library** – Unified, filterable access to all documents and forms"
                    ]
                ]
            ]
        ];

        Project::updateOrCreate(
            ['slug' => 'provider-resource-center-prc-redesign'],
            [
                'title' => 'Provider Resource Center (PRC) Redesign',
                'description' => "Redesigning the digital front door to the leading provider network, enabling healthcare providers to stay informed, self-serve efficiently, and participate in key programs that support patient care.",
                'content_blocks' => $prcBlocks,
                'category_id' => 1, // Health Care category
                'client_name' => 'Highmark',
                'is_featured' => false,
                'order' => 16,
                'tags' => ['CMS', 'Adobe AEM', 'Health Care', 'New Design System Update', 'Redesign', '2023']
            ]
        );

        // This project is public (no client password protection)
    }
}
