'use strict';
 
module.exports = function (grunt) {
    grunt.initConfig({
        pkg : grunt.file.readJSON('package.json'),
        watch: {
            coffee: {
                files: ['src/**/*.coffee'],
                tasks: ['coffee', 'sync']
            },
            assets: {
                files: ['src/assets/*', 'src/views/*'],
                tasks: ['sync'],
                options: {
                    livereload: true
                }
            },
            sass: {
                files: ['src/sass/*.scss'],
                tasks: ['sass'],
                options: {
                    livereload: true
                }
            }
        },
        coffee: {
            options: {
                bare: true
            },
            compile: {
                expand: true,
                cwd: 'src',
                src: '**/*.coffee',
                dest: 'app',
                ext: '.js'
            }
        },
        sync: {
            main: {
                files: [
                    {
                        cwd: 'src/assets',
                        src: '*',
                        dest: 'app/assets',
                    },
                    {
                        cwd: 'src/views',
                        src: '*',
                        dest: 'app/views',
                    }
                ]
            }
        },
        sass: {
            options: {
                style: 'expanded'
            },
            dev: {
                files: [{
                    expand: true,
                    cwd: 'src/sass',
                    src: '*.scss',
                    dest: 'app/public/css',
                    ext: '.css'
                }]
            }
        }
    });
 
    // NPM Tasks
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-coffee');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-jade');
    grunt.loadNpmTasks('grunt-sync');
 
 
    grunt.registerTask('default', ['coffee', 'sync', 'sass']);
};
